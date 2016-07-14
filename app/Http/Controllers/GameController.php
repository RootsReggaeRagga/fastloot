<?php

namespace App\Http\Controllers;

use App\Bet;
use App\Double;
use App\Game;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SteamItem;
use App\Item;
use App\Ticket;
use App\Bots;
use App\User;
use App\Inventory;
use App\DoubleBets;
use App\WinnerTicket;
use App\Http\Controllers\RandomOrgClient;
use Carbon\Carbon;
use App\Config;
use Illuminate\Support\Facades\Redis;
use Request;

class GameController extends Controller
{

    const NEW_BET_CHANNEL = 'newDeposit';
    const BET_DECLINE_CHANNEL = 'depositDecline';
    const INFO_CHANNEL = 'msgChannel';
    const SHOW_WINNERS = 'show.winners';
    const color = ['rgb(178, 34, 39)', 'rgb(48, 216, 216)', 'rgb(179, 121, 44)'];
    private static $chances_cache = [];
    public $game;
    public $config;
    protected $lastTicket = 0;

    public function __construct()
    {
        parent::__construct();
        $this->config = Config::find(1);
        $this->game = $this->getLastGame();
        $this->lastTicket = Redis::get('last.ticket.' . $this->game->id);
        if (is_null($this->lastTicket)) $this->lastTicket = 0;
    }

    public function getLastGame()
    {
        $game = Game::orderBy('id', 'desc')->first();
        if (is_null($game)) $game = $this->newGame();
        return $game;
    }

    public function newGame()
    {
        $rand_number = "0." . mt_rand(100000000, 999999999) . mt_rand(100000000, 999999999);
        $game = Game::create(['rand_number' => $rand_number]);
        $game->hash = hash('SHA224', $game->rand_number);
        $game->rand_number = 0;
        Redis::set('stats', json_encode(['maxwin' => Game::where('status', 3)->max('price'), 'usertoday' => count(Game::join('bets', 'games.id', '=', 'bets.game_id')->join('users', 'bets.user_id', '=', 'users.id')->where('games.created_at', '>=', Carbon::today())->groupBy('users.username')->select('users.username')->get()), 'gametoday' => Game::where('status', 3)->where('created_at', '>=', Carbon::today())->count()]));
        return $game;
    }

    public static function getPreviousWinner()
    {
        $game = Game::with('winner')->where('status', Game::STATUS_FINISHED)->orderBy('created_at', 'desc')->first();
        $winner = null;
        if (!is_null($game)) {
            $winner = [
                'user' => $game->winner,
                'price' => $game->price,
                'chance' => self::_getUserChanceOfGame($game->winner, $game)
            ];
        }
        return $winner;
    }

    public static function _getUserChanceOfGame($user, $game)
    {
        $chance = 0;
        if (!is_null($user)) {
            //if(isset(self::$chances_cache[$user->id])) return self::$chances_cache[$user->id];
            $bet = Bet::where('game_id', $game->id)
                ->where('user_id', $user->id)
                ->sum('price');
            if ($bet)
                $chance = round($bet / $game->price, 3) * 100;
            //self::$chances_cache[$user->id] = $chance;
        }
        return $chance;
    }

    public static function _getUserChanceOfGameByUser($user_id, $game_id, $game_price)
    {
        $chance = 0;
        if (!is_null($user)) {
            //if(isset(self::$chances_cache[$user->id])) return self::$chances_cache[$user->id];
            $bet = Bet::where('game_id', $game_id)
                ->where('user_id', $user_id)
                ->sum('price');
            if ($bet)
                $chance = round($bet / $game_price, 3) * 100;
            //self::$chances_cache[$user->id] = $chance;
        }
        return $chance;
    }

    public function deposit()
    {
        return redirect(self::BOT_TRADE_LINK);
    }


    public function currentGame()
    {
        /* CLASSICAL */
        $game = Game::orderBy('id', 'desc')->first();
        $percents = $this->_getChancesOfGame($game, true);
        $bets = $game->bets()->with(['user', 'game'])->get()->sortByDesc('created_at');
        $user_chance = $this->_getUserChanceOfGame($this->user, $game);
        if (!is_null($this->user))
            $user_items = $this->user->itemsCountByGame($game);
        return view('pages.index', compact('game', 'double', 'bets', 'user_chance', 'user_items', 'percents'));
    }

    private function _getChancesOfGame($game, $is_object = false)
    {
        $chances = [];
        foreach ($game->users() as $user) {
            if ($is_object) {
                $chances[] = (object)[
                    'chance' => $this->_getUserChanceOfGame($user, $game),
                    'avatar' => $user->avatar,
                    'items' => User::find($user->id)->itemsCountByGame($game),
                    'steamid64' => $user->steamid64
                ];
            } else {
                $chances[] = [
                    'chance' => $this->_getUserChanceOfGame($user, $game),
                    'avatar' => $user->avatar,
                    'items' => User::find($user->id)->itemsCountByGame($game),
                    'steamid64' => $user->steamid64
                ];
            }

        }
        return $chances;
    }

    public function lastwinner()
    {
        $last_winner = Game::where('status', '=', 3)->where('showwinner', 0)->orderBy('id', 'desc')->take(1)->first();
        $last_winner->showwinner = 1;
        $last_winner->save();
        $user = User::find($last_winner->winner_id);
        $returnValue = [
            'username' => $user->username,
            'avatar' => $user->avatar,
            'steamid64' => $user->steamid64,
            'percent' => $this->_getUserChanceOfGame($user, $last_winner),
            'price' => $last_winner->price
        ];
        return response()->json($returnValue);
    }

    public function getCurrentGame()
    {
        $this->game->winner;
        return $this->game;
    }

    public function getWinners()
    {

        $us = $this->_getChancesOfGame($this->game, true);
      //  $us = $this->game->users();
        $lastBet = Bet::where('game_id', $this->game->id)->orderBy('to', 'desc')->first();
        $random = new RandomOrgClient();
        $arrRandomInt = $random->generateIntegers(1, 1, $lastBet->to, false, 10, true);
        $winTicket = $arrRandomInt[0];

        /*
         $winTicket = WinnerTicket::where('game_id', $this->game->id)->first();
         if ($winTicket == null) {
             $winTicket = ceil($this->game->rand_number * $lastBet->to);
         } else {
             $winTicket = $winTicket->winnerticket;
             $this->game->rand_number = $winTicket / $lastBet->to;
             if (strlen($this->game->rand_number) < 20) {
                 $diff = 20 - strlen($this->game->rand_number);
                 $min = "1";
                 $max = "9";
                 for ($i = 1; $i < $diff; $i++) {
                     $min .= "0";
                     $max .= "9";
                 }
                 $this->game->rand_number = $this->game->rand_number . "" . rand($min, $max);
             }
         }*/

        $winningBet = Bet::where('game_id', $this->game->id)->where('from', '<=', $winTicket)->where('to', '>=', $winTicket)->first();
        $this->game->winitem = json_encode(json_decode($winningBet->items)[0]);
        $this->game->winner_id = $winningBet->user_id;
        $this->game->status = Game::STATUS_FINISHED;
        $this->game->finished_at = Carbon::now();
        $this->game->signature = $random->last_response['result']['signature'];
        $this->game->random = json_encode($random->last_response['result']['random']);
        $this->game->number = $winTicket;
        $this->game->won_items = json_encode($this->sendItems($this->game->bets, $this->game->winner));
        $this->game->percent = $this->_getUserChanceOfGame($this->game->winner, $this->game);
        $this->game->save();

        $returnValue = [
            'game' => $this->game,
            'winner' => $this->game->winner,
            'round_number' => $this->game->rand_number,
            'ticket' => $winTicket,
            'tickets' => $lastBet->to,
            'number' => $winTicket,
            'users' => $us,
            'random' => json_encode($random->last_response['result']['random']),
            'signature' => $random->last_response['result']['signature'],
            'winitem' => $this->game->winitem,
            'ticketwin' => json_encode(['from' => $winningBet->from, 'to' => $winningBet->to]),
            'chance' => $this->_getUserChanceOfGame($this->game->winner, $this->game)
        ];

        Redis::del('last.ticket.' . $this->game->id);

        return response()->json($returnValue);
    }

    public function sendItems($bets, $user)
    {

        $itemsInfo = [];
        $items = [];
        $commission = $this->config->COMMISSION;
        $commissionItems = [];
        $returnItems = [];
        $tempPrice = 0;
        $firstBet = Bet::where('game_id', $this->game->id)->orderBy('created_at', 'asc')->first();
        if ($firstBet->user == $user) $commission = $this->config->COMMISSION_FOR_FIRST_PLAYER;
        $commissionPrice = round(($this->game->price / 100) * $commission);
        foreach ($bets as $bet) {
            $betItems = json_decode($bet->items, true);
            foreach ($betItems as $item) {
                //(Отдавать всю ставку игроку обратно)
                $item['userid'] = $bet->user_id;
                if ($bet->user == $user) {
                    Inventory::find($item['id'])->update(['userid' => $bet->user_id, 'status' => 0]);
                    $itemsInfo[] = $item;
                } else {
                    if (($item['price'] <= $commissionPrice) && ($tempPrice < $commissionPrice)) {
                        Inventory::find($item['id'])->delete();
                        $commissionItems[] = $item;
                        $tempPrice = $tempPrice + $item['price'];
                    } else {
                        Inventory::find($item['id'])->update(['userid' => $bet->user_id, 'status' => 0]);
                        $itemsInfo[] = $item;
                    }
                }
            }
        }


        $value = [
            'appId' => $this->config->APPID,
            'steamid' => $user->steamid64,
            'accessToken' => $user->accessToken,
            'items' => $returnItems,
            'game' => $this->game->id
        ];


        return $itemsInfo;
    }

    public function newBet()
    {
        if (\Cache::has('bet.user.' . $this->user->id)) return 0;
        \Cache::put('bet.user.' . $this->user->id, '', 0.02);

        if (is_null(Request::get('items')) || Request::get('items') == '[]' || is_numeric(Request::get('items'))) return response()->json(['errors' => 'Вы не выбрали вещей!']);
        $user = $this->user;
        $totalItems = $this->user->itemsCountByGame($this->game);
        if ($this->game->status == Game::STATUS_PRE_FINISH || $this->game->status == Game::STATUS_FINISHED) {
            return response()->json(['errors' => 'Дождитесь следующей игры!']);
        }
        if ($totalItems > $this->config->MAX_ITEMS || $totalItems + count(json_decode(Request::get('items'))) > $this->config->MAX_ITEMS || count(json_decode(Request::get('items'))) > $this->config->MAX_ITEMS) {
            return response()->json(['errors' => 'Максимальное кол-во предметов для депозита - ' . $this->config->MAX_ITEMS]);
        }
        $newBet['price'] = 0;
        $this->lastTicket = Redis::get('last.ticket.' . $this->game->id);
        if (is_null($this->lastTicket)) $this->lastTicket = 0;

        $ticketFrom = 1;
        if ($this->lastTicket != 0)
            $ticketFrom = $this->lastTicket + 1;

        $tickbet = $ticketFrom;
        $i = 0;
        $newBet['items'] = [];
        foreach (json_decode(Request::get('items')) as $itm) {
            $item = Inventory::select('id', 'classid', 'userid', 'name', 'market_hash_name')->find($itm);
            if (is_null($item) || $item->userid != $this->user->id || $item->stauts == 1) return response()->json(['errors' => 'В вашем инвентаре нету такой вещи!']);
            $item->status = 1;
            $item->save();
            $info = Item::where('classid', $item->classid)->first();
            if (is_null($info)) {
                $info = new SteamItem($item);
                if ($info->price != null) {
                    Item::create((array)$info);
                }
            }
            $item->name = $item->name;
            $item->market_hash_name = $info->market_hash_name;
            $item->price = $info->price;
            $item->rarity = $info->rarity;
            $item->color = $info->color;
            $item->backgroundcolor = $info->backgroundcolor;
            $item->from = $tickbet;
            $item->to = ceil($item->from + $info->price * 1.5) - 1;
            $tickbet = ceil($item->from + $info->price * 1.5);
            array_push($newBet['items'], $item);
            $newBet['price'] += $info->price;

        }

        if (is_null($newBet['items'])) return response()->json(['errors' => 'В вашем инвентаре нету такой вещи!']);


        $ticketTo = $ticketFrom + ceil($newBet['price'] * 1.5) - 1;
        Redis::set('last.ticket.' . $this->game->id, $ticketTo);

        $bet = new Bet();
        $bet->user()->associate($user);
        $bet->items = json_encode(array_reverse($newBet['items']));
        $bet->itemsCount = count($newBet['items']);
        $bet->price = ceil($newBet['price']);
        $bet->from = $ticketFrom;
        $bet->to = $ticketTo;
        $bet->game()->associate($this->game);
        $bet->save();

        $bets = Bet::where('game_id', $this->game->id);
        $this->game->items = $bets->sum('itemsCount');
        $this->game->price = $bets->sum('price');

        if (count($this->game->users()) >= $this->config->MIN_USERS || $this->game->items >= $this->config->MAX_ITEMSALL) {
            $this->game->status = Game::STATUS_PLAYING;
            $this->game->started_at = Carbon::now();
        }

        if ($this->game->items >= $this->config->MAX_ITEMSALL) {
            $this->game->status = Game::STATUS_FINISHED;
            Redis::publish(self::SHOW_WINNERS, true);
        }

        $this->game->save();

        $chances = $this->_getChancesOfGame($this->game);
        $returnValue = [
            'betId' => $bet->id,
            'userId' => $user->steam64,
            'html' => view('includes.bet', compact('bet'))->render(),
            'itemsCount' => $this->game->items,
            'gamePrice' => $this->game->price,
            'gameStatus' => $this->game->status,
            'chances' => $chances
        ];

        Redis::publish(self::NEW_BET_CHANNEL, json_encode($returnValue));
        Redis::set('stats', json_encode(['maxwin' => Game::where('status', 3)->max('price'), 'usertoday' => count(Game::join('bets', 'games.id', '=', 'bets.game_id')->join('users', 'bets.user_id', '=', 'users.id')->where('games.created_at', '>=', Carbon::today())->groupBy('users.username')->select('users.username')->get()), 'gametoday' => Game::where('status', 3)->where('created_at', '>=', Carbon::today())->count()]));
        return response()->json(['success' => 'Ставка принята']);

    }

    public function setGameStatus()
    {
        $this->game->status = Request::get('status');
        $this->game->save();
        return $this->game;
    }

    public function setPrizeStatus()
    {
        $game = Game::find(Request::get('game'));
        $game->status_prize = Request::get('status');
        $game->save();
        return $game;
    }

    public function newdepositapi()
    {


        $data = Redis::lrange('checkTrade', 0, -1);
        foreach ($data as $i) {
            $info = json_decode($i);
            $user = User::find($info->userid);
            foreach ($info->items as $item) {
                $inventory = new Inventory();
                $inventory->userid = $info->userid;
                $inventory->inventoryId = $item->id;
                $inventory->bot = $info->bot;
                $inventory->market_hash_name = $item->market_hash_name;
                $inventory->name = $item->market_name;
                $inventory->classid = $item->classid;
                $inventory->type =  $item->type;
                $inventory->save();
            }
            Redis::lrem('checkTrade', 0, $i);
            \Cache::forget('inventory_' . $user->steamid64);
            return $this->_responseSuccess();
        }
    }

    private function _responseSuccess()
    {
        return response()->json(['success' => true]);
    }


    public function without()
    {

        if (empty($this->user->trade_link)) return response()->json(["errors" => "Укажите ссылку на обмен!"]);
        if (is_null(Request::get('items')) || Request::get('items') == '[]' || is_numeric(Request::get('items'))) return response()->json(['errors' => 'Вы не выбрали вещей!']);


        $itemtotake = [];
        $bot = 0;
        foreach (json_decode(Request::get('items')) as $itm) {
            $item = Inventory::select('id', 'classid','inventoryId','bot', 'userid', 'name', 'market_hash_name')->find($itm);
            $bot = $item->bot;
            if (is_null($item) || $item->userid != $this->user->id || $item->stauts == 1) return response()->json(['errors' => 'В вашем инвентаре нету такой вещи!']);
            if($bot == $item->bot){
                array_push($itemtotake, ['id' => $item->inventoryId, 'classid' => $item->classid, 'market_name' => $item->market_name, 'type' => $item->type, 'market_hash_name' => $item->market_hash_name]);
                $item->delete();
            }
        }

        $value = [
            'appId' => $this->config->APPID,
            'trade' => $this->user->trade_link,
            'items' => $itemtotake,
            'userid' => $this->user->id,
            'user' => $this->user->steamid64,
            'bot' => $bot,
            'code' => hash('adler32', $this->config->APPID . mt_rand(1, 99) . $this->user->id)
        ];
        Redis::rpush('send.items', json_encode($value));

        if(count($itemtotake) < count(json_decode(Request::get('items')))) return response()->json(['errors' => 'Трейд отправлен , но отправлены не все вещи , попробуйте ещё раз!']);
        return response()->json(['success' => 'Запрос на трейд отправлен!']);

    }


    public function newdeposit()
    {

        if (empty($this->user->trade_link)) return response()->json(["errors" => "Укажите ссылку на обмен!"]);
        if (is_null(Request::get('items')) || Request::get('items') == '[]' || is_numeric(Request::get('items'))) return response()->json(['errors' => 'Вы не выбрали вещей!']);
        if (\Cache::has('dep.user.' . $this->user->id)) return response()->json(['errors' => 'Ожидайте трейд!']);
        \Cache::put('dep.user.' . $this->user->id, '', 0.06);
        $itemtotake = [];
        $items = \Cache::get('inventory_' . $this->user->steamid64);
        $deposit = json_decode(Request::get('items'));
        foreach ($items as $item) {
            for ($i = 0; $i < count($deposit); $i++) {
                if ($deposit[$i] == $item->id) {
                    array_push($itemtotake, ['id' => $item->id, 'classid' => $item->classid, 'market_name' => $item->market_name, 'type' => $item->type, 'market_hash_name' => $item->market_hash_name]);
                }
            }
        }
        $bot = Bots::select('id')->orderByRaw("RAND()")->take(1)->first();
        $value = [
            'appId' => $this->config->APPID,
            'trade' => $this->user->trade_link,
            'items' => $itemtotake,
            'userid' => $this->user->id,
            'user' => $this->user->steamid64,
            'bot' => $bot->id,
            'code' => hash('adler32', $this->config->APPID . mt_rand(1, 99) . $this->user->id)
        ];
        Redis::rpush('take.items', json_encode($value));
    }

    public function getBalance()
    {
        return $this->user->money;
    }

    private function _responseMessageToSite($message, $user)
    {
        return Redis::publish(self::INFO_CHANNEL, json_encode([
            'user' => $user,
            'msg' => $message
        ]));
    }

}
