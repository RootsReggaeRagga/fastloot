<?php namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Services\SteamItem;
use App\Stor;
use App\User;
use App\Item;
use Request;
use Carbon\Carbon;

class Store extends Controller
{

    const SEND_OFFERS_LIST = 'send.offers.list';
    const New_Messages = 'New_Messages';
    const GIVE_ITEMS_CHANNEL = 'deposit.send.offers.list';
    const BET_DECLINE_CHANNEL = 'depositDecline';
    const MinimalPrice = '1'; // Минимальный депозит

    public function buy()
    {

        if (!$this->user->trade_link) return response()->json(['errors' => 'Введите ссылку на обмен']);

        $array = explode("|", Request::get('item'));
        $i = 0;
        $price = 0;
        foreach ($array as $item) {
            $price += Stor::find($item)->price;
            $i++;
        }
        if ($this->user->money < $price) return response()->json(['errors' => 'У Вас не хватает очков для покупки этого предмета']);
        $this->user->money -= $price;
        $this->user->save();
        foreach ($array as $item) {
                $item = Stor::find($item);
                $item->buyer_id = $this->user->id;
                $item->save();
                $this->sendItem($this->user, $item);
        }

        return response()->json(['success' => 'True']);
    }

    public function setItemStatus()
    {
        $item = Stor::find(Request::get('id'));
        if (!is_null($item)) {
            $item->status = Request::get('status');
            $item->save();
            return $item;
        }
        return response()->json(['success' => false]);
    }


    public function sendItem($user, $item)
    {

        $value = [
            'appId' => 730,
            'steamid' => $user->steamid64,
            'accessToken' => $user->accessToken,
            'items' => $item->classid,
            'id' => $item->id
        ];


        $this->redis->rpush(self::GIVE_ITEMS_CHANNEL, json_encode($value));
    }


    public function index()
    {
        if (Request::get('search'))
            $items = Stor::where('buyer_id',NULL)->orderBy('price', Request::get('price'))->where('name', 'LIKE', '%' . Request::get("search") . '%')->paginate(35);
        else if (Request::get('name'))
            $items = Stor::where('buyer_id',NULL)->orderBy('name', Request::get('name'))->paginate(35);
        else if (Request::get('price'))
            $items = Stor::where('buyer_id',NULL)->orderBy('price', Request::get('price'))->paginate(35);
        else
            $items = Stor::where('buyer_id',NULL)->orderBy('price', 'desc')->paginate(35);
        foreach ($items as $i) {
            $i->color = $this->getClassRarity($i->rarity)['bgColor'];
            $i->fontcolor = $this->getClassRarity($i->rarity)['fontColor'];
        }
        return view('pages.store', compact('items'));
    }

    public function getClassRarity($type)
    {
        switch ($type) {

            case 'Армейское качество':
                $b = '#3A5BFF';
                $c = '#FFF';
                break;
            case 'Запрещенное':
                $b = 'rgb(135, 73, 255)';
                $c = '#FFF';
                break;
            case 'Засекреченное':
                $b = 'rgb(212, 45, 186)';
                $c = '#FFF';
                break;
            case 'Тайное':
                $b = 'rgb(227, 65, 50)';
                $c = '#FFF';
                break;
            case 'StatTrak\u2122':
                $b = 'rgb(207, 106, 50)';
                $c = '#FFF';
                break;
            case '\u2605':
            case '\u2605 StatTrak\u2122':
            case 'Контрабандное':
                $b = 'rgb(246, 228, 70)';
                $c = '#3f4c52';
                break;
            default:
                $b = 'rgb(255,255,255)';
                $c = '#3f4c52';
        }
        return ['bgColor' => $b, 'fontColor' => $c];

    }

    public function newitem()
    {
        $data = $this->redis->lrange('deposit.newitem.list', 0, -1);
        foreach ($data as $newDepJson) {
            $newDep = json_decode($newDepJson, true);
            $user = User::find($newDep['userid']);
            if (is_null($user)) continue;
            foreach ($newDep['items'] as $item) {

                $dbItemInfo = Item::where('market_hash_name', $item['market_hash_name'])->first();
                if (is_null($dbItemInfo)) {
                    $itemInfo = new SteamItem($item);
                    $item['steam_price'] = $itemInfo->price;
                    $item['price'] = $dbItemInfo->price;
                    Stor::create($item);
                } else {
                    $item['steam_price'] = $dbItemInfo->price;
                    $item['price'] = $dbItemInfo->price;
                    Stor::create($item);
                }
            }

            $user->money += $newDep['price'];
            $user->save();
            $this->redis->lrem('deposit.newitem.list', 0, $newDepJson);
            $this->_responseSuccessToSite('Ваш счёт пополнен на ' . $newDep['price'] . ' фаст поинт', $user->steamid64, self::New_Messages);
        }

        return response()->json(['success' => true]);
    }

    private function _responseSuccessToSite($message, $user, $channel)
    {
        return $this->redis->publish($channel, json_encode([
            'user' => $user,
            'msg' => $message
        ]));
    }

    public function haventescrow(Request $request)
    {
        $this->_responseErrorToSite('Пожалуйста включите escrow!', $request->get('steamid'), self::BET_DECLINE_CHANNEL);
        return response()->json(['success' => true]);

    }


    public function checkOffer()
    {
        $data = $this->redis->lrange('deposit.check.list', 0, -1);

        foreach ($data as $offerJson) {

            $offer = json_decode($offerJson);
            $accountID = $offer->accountid;
            $items = json_decode($offer->items, true);

            $itemsCount = count($items);

            $user = User::where('steamid64', $accountID)->first();

            if (is_null($user)) {
                $this->redis->lrem('deposit.usersQueue.list', 1, $accountID);
                $this->redis->lrem('deposit.check.list', 0, $offerJson);
                $this->redis->rpush('deposit.decline.list', $offer->offerid);
                continue;
            } else {
                if (empty($user->accessToken)) {
                    $this->redis->lrem('deposit.usersQueue.list', 1, $accountID);
                    $this->redis->lrem('deposit.check.list', 0, $offerJson);
                    $this->redis->rpush('deposit.decline.list', $offer->offerid);
                    $this->_responseErrorToSite('Введите трейд ссылку!', $accountID, self::BET_DECLINE_CHANNEL);
                    continue;
                }
            }

            if ($itemsCount > 30) {
                $this->_responseErrorToSite('Максимальное кол-во предметов для депозита - 30', $accountID, self::BET_DECLINE_CHANNEL);
                $this->redis->lrem('deposit.usersQueue.list', 1, $accountID);
                $this->redis->lrem('deposit.check.list', 0, $offerJson);
                $this->redis->rpush('deposit.decline.list', $offer->offerid);
                continue;
            }

            $total_price = $this->_parseItems($items, $missing, $price);

            if ($missing) {
                $this->_responseErrorToSite('Принимаются только предметы из CS:GO', $accountID, self::BET_DECLINE_CHANNEL);
                $this->redis->lrem('deposit.usersQueue.list', 1, $accountID);
                $this->redis->lrem('deposit.check.list', 0, $offerJson);
                $this->redis->rpush('deposit.decline.list', $offer->offerid);
                continue;
            }

            if ($price) {
                $this->_responseErrorToSite('Невозможно определить цену одного из предметов', $accountID, self::BET_DECLINE_CHANNEL);
                $this->redis->lrem('deposit.usersQueue.list', 1, $accountID);
                $this->redis->lrem('deposit.check.list', 0, $offerJson);
                $this->redis->rpush('deposit.decline.list', $offer->offerid);
                continue;
            }

            if ($total_price < self::MinimalPrice) {
                $this->_responseErrorToSite('Минимальная сумма депозита ' . self::MinimalPrice . ' р.', $accountID, self::BET_DECLINE_CHANNEL);
                $this->redis->lrem('deposit.usersQueue.list', 1, $accountID);
                $this->redis->lrem('deposit.check.list', 0, $offerJson);
                $this->redis->rpush('deposit.decline.list', $offer->offerid);
                continue;
            }

            $returnValue = [
                'offerid' => $offer->offerid,
                'userid' => $user->id,
                'steamid64' => $user->steamid64,
                'items' => $items,
                'price' => $total_price,
                'success' => true
            ];


            $this->redis->rpush('deposit.checked.list', json_encode($returnValue));
            $this->redis->lrem('deposit.check.list', 0, $offerJson);

        }

        return response()->json(['success' => true]);
    }

    private function _responseErrorToSite($message, $user, $channel)
    {
        return $this->redis->publish($channel, json_encode([
            'user' => $user,
            'msg' => $message
        ]));
    }

    private function _parseItems(&$items, &$missing = false, &$price = false)
    {
        $itemInfo = [];
        $total_price = 0;
        $i = 0;

        foreach ($items as $item) {
            $value = $item['classid'];
            if ($item['appid'] != 730) {
                $missing = true;
                break;
            }
            $dbItemInfo = Item::where('market_hash_name', $item['market_hash_name'])->first();
            if (is_null($dbItemInfo)) {
                if (!isset($itemInfo[$item['classid']]))
                    $itemInfo[$value] = new SteamItem($item);

                $dbItemInfo = Item::create((array)$itemInfo[$item['classid']]);

                if (!$itemInfo[$value]->price) $price = true;
            } else {
                if ($dbItemInfo->updated_at->getTimestamp() < Carbon::now()->subHours(5)->getTimestamp()) {
                    $si = new SteamItem($item);
                    if (!$si->price) $price = true;
                    if (!$si->price) $price = true;
                    $dbItemInfo->price = $si->price;
                    $dbItemInfo->save();
                }
            }

            $itemInfo[$value] = $dbItemInfo;

            if (!isset($itemInfo[$value]))
                $itemInfo[$value] = new SteamItem($item);
            if (!$itemInfo[$value]->price) $price = true;
            if ($itemInfo[$value]->price < 1) $itemInfo[$value]->price = 1;
            $total_price = $total_price + $itemInfo[$value]->price;
            $items[$i]['price'] = $itemInfo[$value]->price;
            unset($items[$i]['appid']);
            $i++;
        }
        return $total_price;
    }

}
