<?php namespace App\Http\Controllers;


use DB;
use Request;
use Auth;
use Cache;
use App\Item;
use App\User;
use App\Game;
use App\Inventory;
use Carbon\Carbon;

class Pages extends Controller
{

    public function index()
    {


        return view('pages.index');
    }

    public function test()
    {
        // return Request::session()->all();
    }

    public function ladder()
    {

        $ladder = User::select('users.id',
            'users.username',
            'users.avatar',
            'users.steamid64',
            \DB::raw('SUM(games.price) as top_value'),
            \DB::raw('COUNT(games.id) as wins_count')
        )
            ->join('games', 'games.winner_id', '=', 'users.id')
            ->groupBy('users.id')
            ->orderBy('top_value', 'desc')
            ->limit(20)
            ->get();
        $place = 1;
        $rank = 1;
        $i = 0;
        foreach ($ladder as $u) {
            if ($i != 0 and $i == 1 | $i == 2 || $i % 3 == 0 and $i < 45) $rank++;
            $ladder[$i]->rank = $rank;
            $ladder[$i]->games_played = count(\DB::table('games')
                ->join('bets', 'games.id', '=', 'bets.game_id')
                ->where('bets.user_id', $u->id)
                ->groupBy('bets.game_id')
                ->select('bets.id')->get());
            $ladder[$i]->win_rate = round($ladder[$i]->wins_count / $ladder[$i]->games_played, 3) * 100;
            $ladder[$i]->place = $place;
            $place++;
            $i++;
        }
        $ladder->gametoday = Game::where('status', 3)->where('created_at', '>=', Carbon::today())->count();
        $ladder->moneytoday = Game::where('created_at', '>=', Carbon::today())->where('status', 3)->max('price');
        $ladder->alluser = User::count();
        $ladder->unqiuser = count(Game::join('bets', 'games.id', '=', 'bets.game_id')->join('users', 'bets.user_id', '=', 'users.id')->where('games.created_at', '>=', Carbon::today())->groupBy('users.username')->select('users.username')->get());
        return view('pages.ladder', compact('ladder'));
    }


    public function myhistory()
    {
        $history = Game::with(['bets', 'winner'])->where('status', '=', 3)->where('showwinner', 1)->where('winner_id', $this->user->id)->orderBy('created_at', 'desc')->take(15)->get();
        foreach ($history as $game) {
            $game->userblock = $this->_getChancesOfGame($game, true);
            $game->won_items = json_decode($game->won_items);
        }

        return view('includes.history', compact('history'))->render();
    }


    public function history()
    {
        $history = Game::with(['bets', 'winner'])->where('status', '=', 3)->where('showwinner', 1)->orderBy('created_at', 'desc')->take(15)->get();
        foreach ($history as $game) {
            $game->userblock = $this->_getChancesOfGame($game, true);
            $game->won_items = json_decode($game->won_items);


        }

        return view('pages.history', compact('history'));
    }

    public function game($gameId)
    {


        if (isset($gameId) && Game::where('status', Game::STATUS_FINISHED)->where('id', $gameId)->count()) {
            $game = Game::with(['winner'])->where('status', Game::STATUS_FINISHED)->where('id', $gameId)->first();
            $game->ticket = floor($game->rand_number * ($game->price * 100));
            $bets = $game->bets()->with(['user', 'game'])->get()->sortByDesc('created_at');

            $chances = [];
            $percents = $this->_getChancesOfGame($game, true);
            return view('pages.game', compact('game', 'bets', 'chances', 'percents'));
        }
        return redirect()->route('index');
    }


    public function faq()
    {


        return view('pages.faq');
    }

    public function settings()
    {


        return view('pages.settings');
    }


    private function _getChancesOfGame($game, $is_object = false)
    {
        $chances = [];
        foreach ($game->users() as $user) {
            if ($is_object) {
                $chances[] = (object)[
                    'chance' => GameController::_getUserChanceOfGame($user, $game),
                    'avatar' => $user->avatar,
                    'items' => User::find($user->id)->itemsCountByGame($game),
                    'steamid64' => $user->steamid64
                ];
            } else {
                $chances[] = [
                    'chance' => GameController::_getUserChanceOfGame($user, $game),
                    'avatar' => $user->avatar,
                    'items' => User::find($user->id)->itemsCountByGame($game),
                    'steamid64' => $user->steamid64
                ];
            }

        }
        return $chances;
    }


    public function my_inventory_tosite()
    {

        $items = Inventory::select('id', 'classid','inventoryId','name','market_hash_name')->where('userid', $this->user->id)->orderBy('id', 'desc')->where('status', 0);
        if ($items->count() == 0) return 'false';
        if ($items->count() != count(Cache::get('my_inventory_tosite_' . $this->user->steamid64))) {
            Cache::forget('my_inventory_tosite_' . $this->user->steamid64);
            $items = $items->get();
            foreach ($items as $i) {
                $info = Item::where('classid', $i['classid'])->first();
                if (is_null($info)) {
                    if (is_null($i->market_hash_name)) {
                        $homepage = file_get_contents('http://api.steampowered.com/ISteamEconomy/GetAssetClassInfo/v0001?key=9D56AA1135B684BC5ECAE13DC8038737&format=json&language=ru&appid=730&class_count=2&classid0=0&classid1=' . $i['classid'] . '');
                        $json = json_decode($homepage, true);
                        $i->market_hash_name = $json['result'][$i['classid']]['market_hash_name'];
                        $i->name = $json['result'][$i['classid']]['market_name'];
                        $i->type = $json['result'][$i['classid']]['type'];
                    }
                    $info = new SteamItem($i);
                    if ($info->price != null) {
                        Item::create((array)$info);
                    }
                } else {
                    if ($info->updated_at->getTimestamp() < Carbon::now()->subHours(5)->getTimestamp()) {
                        $si = new SteamItem($info);
                        if (!$si->price) $si->price = $info->price;
                        $info->price = $si->price;
                        $info->save();
                    }
                }
                $i->price = $info->price;
                $i->market_hash_name = $info->market_hash_name;
            }
            Cache::put('my_inventory_tosite_' . $this->user->steamid64, $items, 900);
        } else {
            $items = Cache::get('my_inventory_tosite_' . $this->user->steamid64);
        }
        return $items;
    }


    public function myinventory()
    {
        if (empty($this->user->trade_link)) return response()->json(["errors" => "Укажите ссылку на обмен!"]);
        Cache::forget('inventory_' . $this->user->steamid64);
        if (!Cache::has('inventory_' . $this->user->steamid64)) {
            $jsonInventory = file_get_contents('http://steamcommunity.com/profiles/' . $this->user->steamid64 . '/inventory/json/730/2?l=russian&trading=1');
            $inventory = json_decode($jsonInventory, true);
            $items = [];
            if ($inventory['success']) {

                foreach ($inventory['rgInventory'] as $class_info => $item_info) {
                    $item = $inventory['rgDescriptions'][$item_info['classid'] . '_' . $item_info['instanceid']];

                    $info = Item::where('market_hash_name', $item['market_hash_name'])->first();
                    if (is_null($info)) {
                        $info = new SteamItem($item);
                        if ($info->price != null) {
                            Item::create((array)$info);
                        }
                    }

                    $info->market_name = $item['market_name'];
                    $info->id = $item_info['id'];
                    $items[] = $info;
                }

            }
            Cache::put('inventory_' . $this->user->steamid64, $items, 15);
        } else {
            $items = Cache::get('inventory_' . $this->user->steamid64);
        }
        return $items;
    }



    public function postLang($lang)
    {
        if (in_array($lang, $this->languages)) {
            \Session::set('lang', $lang);
            if (!Auth::guest()) {
                User::where('id', $this->user->id)->update(['language' => $lang]);
            }
        }
        return redirect()->route('index');
    }




}