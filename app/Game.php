<?php

namespace App;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    const STATUS_NOT_STARTED = 0;
    const STATUS_PLAYING = 1;
    const STATUS_PRE_FINISH = 2;
    const STATUS_FINISHED = 3;
    const STATUS_ERROR = 4;

    const STATUS_PRIZE_WAIT_TO_SENT = 0;
    const STATUS_PRIZE_SEND = 1;
    const STATUS_PRIZE_SEND_ERROR = 2;

    protected $fillable = ['rand_number'];





    public function winner()
    {
        return $this->belongsTo('App\User');
    }

    public function users()
    {
        return \DB::table('games')
            ->join('bets', 'games.id', '=', 'bets.game_id')
            ->join('users', 'bets.user_id', '=', 'users.id')
            ->where('games.id', $this->id)
            ->groupBy('users.username')
            ->select('users.*')
            ->get();
    }

    public static function gamesToday()
    {
        return self::where('status', self::STATUS_FINISHED)->where('created_at', '>=', Carbon::today())->count();
    }

    public static function usersToday()
    {
        return count(\DB::table('games')
            ->join('bets', 'games.id', '=', 'bets.game_id')
            ->join('users', 'bets.user_id', '=', 'users.id')
            ->where('games.created_at', '>=', Carbon::today())
            ->groupBy('users.username')
            ->select('users.username')->get());
    }




    public static function maxPriceToday()
    {
        return ($price = self::where('created_at', '>=', Carbon::today())->max('price')) ? $price : 0;
    }

    public static function maxPrice()
    {

		$money = round(self::max('price'));
		$moneyl = strlen($money);
		if($moneyl > 3){$money = round($money/1000);}
        return $money;
    }

	public static function allmoney()
    {
        $maxmoney = \DB::table('games')->sum('price');
    }



	public static function maxITEMS()
    {
		$items = round(\DB::table('bets')->max('id'));
		$itemsl = strlen($items);
		if($itemsl > 3){$items = round($items/1000);}
        return $items;
    }

	 public static function strana()
{

	$ip = $_SERVER['REMOTE_ADDR'];

 $fh = fopen(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'tabgeo_country_v4.dat', 'rb');

    $iso = array('AD', 'AE', 'AF', 'AG', 'AI', 'AL', 'AM', 'AO', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AW', 'AX', 'AZ',
                 'BA', 'BB', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BL', 'BM', 'BN', 'BO', 'BQ', 'BR', 'BS',
                 'BT', 'BV', 'BW', 'BY', 'BZ', 'CA', 'CC', 'CD', 'CF', 'CG', 'CH', 'CI', 'CK', 'CL', 'CM', 'CN',
                 'CO', 'CR', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DE', 'DJ', 'DK', 'DM', 'DO', 'DZ', 'EC', 'EE',
                 'EG', 'EH', 'ER', 'ES', 'ET', 'FI', 'FJ', 'FK', 'FM', 'FO', 'FR', 'GA', 'GB', 'GD', 'GE', 'GF',
                 'GG', 'GH', 'GI', 'GL', 'GM', 'GN', 'GP', 'GQ', 'GR', 'GS', 'GT', 'GU', 'GW', 'GY', 'HK', 'HM',
                 'HN', 'HR', 'HT', 'HU', 'ID', 'IE', 'IL', 'IM', 'IN', 'IO', 'IQ', 'IR', 'IS', 'IT', 'JE', 'JM',
                 'JO', 'JP', 'KE', 'KG', 'KH', 'KI', 'KM', 'KN', 'KP', 'KR', 'KW', 'KY', 'KZ', 'LA', 'LB', 'LC',
                 'LI', 'LK', 'LR', 'LS', 'LT', 'LU', 'LV', 'LY', 'MA', 'MC', 'MD', 'ME', 'MF', 'MG', 'MH', 'MK',
                 'ML', 'MM', 'MN', 'MO', 'MP', 'MQ', 'MR', 'MS', 'MT', 'MU', 'MV', 'MW', 'MX', 'MY', 'MZ', 'NA',
                 'NC', 'NE', 'NF', 'NG', 'NI', 'NL', 'NO', 'NP', 'NR', 'NU', 'NZ', 'OM', 'PA', 'PE', 'PF', 'PG',
                 'PH', 'PK', 'PL', 'PM', 'PN', 'PR', 'PS', 'PT', 'PW', 'PY', 'QA', 'RE', 'RO', 'RS', 'RU', 'RW',
                 'SA', 'SB', 'SC', 'SD', 'SE', 'SG', 'SH', 'SI', 'SJ', 'SK', 'SL', 'SM', 'SN', 'SO', 'SR', 'SS',
                 'ST', 'SV', 'SX', 'SY', 'SZ', 'TC', 'TD', 'TF', 'TG', 'TH', 'TJ', 'TK', 'TL', 'TM', 'TN', 'TO',
                 'TR', 'TT', 'TV', 'TW', 'TZ', 'UA', 'UG', 'UM', 'US', 'UY', 'UZ', 'VA', 'VC', 'VE', 'VG', 'VI',
                 'VN', 'VU', 'WF', 'WS', 'YE', 'YT', 'ZA', 'ZM', 'ZW', 'XA', 'YU', 'CS', 'AN', 'AA', 'EU', 'AP',
    );

	if (!function_exists('tabgeo_bs')) {
		function tabgeo_bs($data_array, $ip, $step){
			$start = 0;
			$end   = count($data_array) - 1;

			while (true) {
				$mid    = floor(($start + $end) / 2);
				$unpack = $step ? unpack('Noffset/Cip/Ccc_id', "\x00$data_array[$mid]") : unpack('Cip/Ccc_id', $data_array[$mid]);

				if ($unpack['ip'] == $ip) return $unpack;
				if ($end - $start  <   0) return $ip > $unpack['ip'] ? $unpack : $unpack_prev;
				if ($unpack['ip']  > $ip) $end = $mid - 1; else $start = $mid + 1;

				$unpack_prev = $unpack;
			}
		}
	}

    $ip_array = explode('.', $ip);

    fseek($fh, ($ip_array[0] * 256 + $ip_array[1]) * 4);
    $index_bin = fread($fh, 4);
    $index = unpack('Noffset/Clength', "\x00$index_bin");
    if($index['offset'] == 16777215) return $iso[$index['length']];

    fseek($fh, $index['offset'] * 5 + 262144);
    $bin = fread($fh, ($index['length'] + 1) * 5);
    $d = tabgeo_bs(str_split($bin, 5), $ip_array[2], TRUE);
    if($d['offset'] == 16777215) return $iso[$d['cc_id']];

    if($ip_array[2] > $d['ip']) $ip_array[3] = 255;
    fseek($fh, -(($d['offset'] + 1 + $d['cc_id']) * 2), SEEK_END);
    $bin = fread($fh, ($d['cc_id'] + 1) * 2);
    $d = tabgeo_bs(str_split($bin, 2), $ip_array[3], FALSE);
    return $iso[$d['cc_id']];


	}




	 public static function online()
{
 return	$users = \DB::table('user_status_online')->count();
}
    public function bets()
    {
        return $this->hasMany('App\Bet');
    }
}
