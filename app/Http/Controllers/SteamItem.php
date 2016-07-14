<?php namespace App\Http\Controllers;

use App\Http\Controllers\GameController;
use App\Http\Controllers\SteamController;
use PragmaRX\Google2FA\Google2FA;

class SteamItem
{


    public $classid;
    public $name;
    public $market_hash_name;
    public $price;
    public $rarity;
    public $color;
    public $backgroundcolor;


    public function __construct($info)
    {

        $this->classid = $info['classid'];
        $this->name = $info['name'];
        $this->market_hash_name = $info['market_hash_name'];
        $this->rarity = isset($info['rarity']) ? $info['rarity'] : $this->getItemRarity($info);
        $info = $this->getColor($this->name);
        $this->color = $info[0];
        $this->backgroundcolor = $info[1];


        if ($price = $this->getItemPrice()) {
            $this->price = round(floatval($price * 64));
        } else {
            $this->_setToFalse();
        }

    }

    public function getItemRarity($info)
    {
        $type = $info['type'];
        $rarity = '';
        $arr = explode(',', $type);
        if (count($arr) == 2) $type = trim($arr[1]);
        if (count($arr) == 3) $type = trim($arr[2]);
        if (count($arr) && $arr[0] == 'Нож') $type = '★';
        switch ($type) {
            case 'Армейское качество':
                $rarity = 'milspec';
                break;
            case 'Запрещенное':
                $rarity = 'restricted';
                break;
            case 'Засекреченное':
                $rarity = 'classified';
                break;
            case 'Тайное':
                $rarity = 'covert';
                break;
            case 'Ширпотреб':
                $rarity = 'common';
                break;
            case 'Промышленное качество':
                $rarity = 'common';
                break;
            case '★':
                $rarity = 'rare';
                break;
        }

        return $rarity;
    }

    public function getItemPrice()
    {
        try {



            $google2fa = new Google2FA();
            $url = 'http://bitskins.com/api/v1/get_item_price/?api_key=8da0e9ac-0f1b-4ea6-b979-e993d056ebf8&code=' . $google2fa->getCurrentOtp('ID2HSNRR6EOGLAGQ') . '&names=' . urlencode($this->market_hash_name);
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $auth = curl_exec($curl);

            if ($auth) {
                $json = json_decode($auth, true);
                return $json['data']['prices'][0]['price'];
            } else
                return false;
        } catch (Exception $e) {
            return false;
        }
    }

    private function _setToFalse()
    {
        $this->name = false;
        $this->price = false;
        $this->rarity = false;
    }

    public function getItemInfo()
    {
        $json = file_get_contents(sprintf(self::STEAM_ITEM_URL, SteamController::steamApiKey, $this->classid));
        $json = json_decode($json, true);
        if ($json["result"]['success'])
            return (object)$json["result"][$this->classid];
        else
            return false;
    }

    public function getColor($name)
    {
        $color = 'rgb(255,255,255)';
        $backgroundcolor = '#3f4c52';

        if (mb_strpos($name, 'Армейское качество')) {
            $color = '#FFF';
            $backgroundcolor = '#FFF';
        } elseif (mb_strpos($name, 'Засекреченное')) {
            $color = '';
            $backgroundcolor = '#FFF';
        } elseif (mb_strpos($name, 'Тайное')) {
            $color = 'rgb(227, 65, 50)';
            $backgroundcolor = '#FFF';
        } elseif (mb_strpos($name, 'Запрещенное')) {
            $color = '';
            $backgroundcolor = '#FFF';
        } elseif (mb_strpos($name, 'StatTrak™')) {
            $color = 'rgb(207, 106, 50)';
            $backgroundcolor = '#FFF';
        }
        if (mb_strpos($name, '★') || mb_strpos($name, '★ StatTrak™') || mb_strpos($name, 'Контрабандное')) {
            $color = 'rgb(246, 228, 70)';
            $backgroundcolor = '#3f4c52';
        }
        return [$color, $backgroundcolor];
    }


}