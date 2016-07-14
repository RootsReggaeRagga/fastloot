<?php namespace App\Http\Controllers;

use App\Http\Controllers\GameController;
use App\Http\Controllers\SteamController;
use Exception;


/**
 * RANDOM.ORG
 * JSON-RPC API – Release 1
 * https://api.random.org/json-rpc/1/
 *
 * @author odan
 * @copyright 2014-2016 odan
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link https://github.com/odan/random-org
 */
class RandomOrgClient
{

    // The URL for invoking the API
    // https://api.random.org/json-rpc/1/
    protected $url = 'https://api.random.org/json-rpc/1/invoke';
    // Random.org API-KEY
    // https://api.random.org/api-keys
    protected $apiKey = 'ff612576-5802-4256-bab3-cf13248ca079';
    // Http time limit
    protected $timeLimit = 300;

    /**
     * Constructor
     */
    function __construct()
    {
        $this->setTimelimit($this->timeLimit);
    }

    /**
     * Set API key
     *
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * This method generates true random integers within a user-defined range.
     *
     * @param int $numbers How many random integers you need.
     * Must be within the [1,1000000000] range.
     * @param int $min The lower boundary for the range from which the
     * random numbers will be picked.
     * Must be within the [-1000000000,1000000000] range.
     * @param int $max The upper boundary for the range from which the
     * random numbers will be picked.
     * Must be within the [-1000000000,1000000000] range.
     * @param type $replacement Specifies whether the random numbers
     * should be picked with replacement. The default (true) will cause the
     * numbers to be picked with replacement, i.e., the resulting numbers
     * may contain duplicate values (like a series of dice rolls).
     * If you want the numbers picked to be unique (like raffle tickets
     * drawn from a container), set this value to false.
     * @param type $base Specifies the base that will be used to display
     * the numbers. Values allowed are 2, 8, 10 and 16.
     * @return array
     */
    public function generateIntegers($numbers, $min, $max, $requestID)
    {
        $replacement = true;
        $base = 10;
        $params = array();
        $params['apiKey'] = $this->apiKey;
        $params['n'] = $numbers;
        $params['min'] = $min;
        $params['max'] = $max;
        $params['replacement'] = $replacement;
        $params['base'] = $base;
        $response = $this->call('generateSignedIntegers', $params, $requestID);

        if (isset($response['error']['message'])) {
            throw new Exception($response['error']['message']);
        }
        $result = array();
        if (isset($response['result']['random']['data'])) {
            $this->last_response = $response;
            $result = $response['result']['random']['data'];
        }
        return $result;
    }

    /**
     * This method generates true random decimal fractions from a uniform
     * distribution across the [0,1] interval with a user-defined number of
     * decimal places.
     *
     * @param int $numbers How many random decimal fractions you need.
     * Must be within the [1,10000] range.
     * @param int $decimalPlaces The number of decimal places to use.
     * Must be within the [1,20] range.
     * @param bool $replacement Specifies whether the random numbers should
     * be picked with replacement. The default (true) will cause the numbers to
     * be picked with replacement, i.e., the resulting numbers may contain
     * duplicate values (like a series of dice rolls).
     * If you want the numbers picked to be unique (like raffle tickets
     * drawn from a container), set this value to false.
     * @return array
     * @throws Exception
     */
    public function generateDecimalFractions($numbers, $decimalPlaces, $replacement = true)
    {
        $params = array();
        $params['apiKey'] = $this->apiKey;
        $params['n'] = $numbers;
        $params['decimalPlaces'] = $decimalPlaces;
        $params['replacement'] = $replacement;
        $response = $this->call('generateDecimalFractions', $params);

        if (isset($response['error']['message'])) {
            throw new Exception($response['error']['message']);
        }
        $result = array();
        if (isset($response['result']['random']['data'])) {
            $result = $response['result']['random']['data'];
        }
        return $result;
    }

    /**
     * This method generates true random numbers from a Gaussian distribution 7
     * (also known as a normal distribution). The form uses a Box-Muller
     * Transform to generate the Gaussian distribution from uniformly
     * distributed numbers.
     *
     * @param int $numbers How many random numbers you need.
     * Must be within the [1,10000] range.
     * @param int $mean The distribution's mean.
     * Must be within the [-1000000,1000000] range.
     * @param int $standardDeviation The distribution's standard deviation.
     * Must be within the [-1000000,1000000] range.
     * @param int $significantDigits The number of significant digits to use.
     * Must be within the [2,20] range.
     * @return array
     * @throws Exception
     */
    public function generateGaussians($numbers, $mean, $standardDeviation, $significantDigits)
    {
        $params = array();
        $params['apiKey'] = $this->apiKey;
        $params['n'] = $numbers;
        $params['mean'] = $mean;
        $params['standardDeviation'] = $standardDeviation;
        $params['significantDigits'] = $significantDigits;

        $response = $this->call('generateGaussians', $params);

        if (isset($response['error']['message'])) {
            throw new Exception($response['error']['message']);
        }
        $result = array();
        if (isset($response['result']['random']['data'])) {
            $result = $response['result']['random']['data'];
        }
        return $result;
    }

    /**
     * This method generates true random strings.
     *
     * @param int $numbers How many random strings you need.
     * Must be within the [1,10000] range.
     * @param int $length The length of each string. Must be within
     * the [1,20] range. All strings will be of the same length
     * @param int $characters A string that contains the set of characters
     * that are allowed to occur in the random strings.
     * The maximum number of characters is 80.
     * @param bool $replacement (true = with duplicates, false = unique)
     * @return array
     * @throws Exception
     */
    public function generateStrings($numbers, $length, $characters = null, $replacement = true)
    {

        if ($characters === null) {
            // default
            $characters = 'abcdefghijklmnopqrstuvwxyz';
            $characters .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $characters .= '0123456789';
        }

        $params = array();
        $params['apiKey'] = $this->apiKey;
        $params['n'] = $numbers;
        $params['length'] = $length;
        $params['characters'] = $characters;
        $params['replacement'] = $replacement;

        $response = $this->call('generateStrings', $params);

        if (isset($response['error']['message'])) {
            throw new Exception($response['error']['message']);
        }
        $result = array();
        if (isset($response['result']['random']['data'])) {
            $result = $response['result']['random']['data'];
        }
        return $result;
    }

    /**
     * This method generates version 4 true random Universally Unique
     * IDentifiers (UUIDs) in accordance with section 4.4 of RFC 4122.
     *
     * @param int $numbers
     * @return array
     * @throws Exception
     */
    public function generateUUIDs($numbers)
    {
        $params = array();
        $params['apiKey'] = $this->apiKey;
        $params['n'] = $numbers;

        $response = $this->call('generateUUIDs', $params);

        if (isset($response['error']['message'])) {
            throw new Exception($response['error']['message']);
        }
        $result = array();
        if (isset($response['result']['random']['data'])) {
            $result = $response['result']['random']['data'];
        }
        return $result;
    }

    /**
     * This method generates Binary Large Objects (BLOBs)
     * containing true random data.
     *
     * @param int $numbers How many random blobs you need.
     * Must be within the [1,100] range.
     * @param int $size The size of each blob, measured in bits.
     * Must be within the [1,1048576] range and must be divisible by 8.
     * @param string $format Specifies the format in which the blobs will
     * be returned. Values allowed are base64 and hex.
     * @return array
     * @throws Exception
     */
    public function generateBlobs($numbers, $size, $format = 'base64')
    {
        $params = array();
        $params['apiKey'] = $this->apiKey;
        $params['n'] = $numbers;
        $params['size'] = $size;
        $params['format'] = $format;

        $response = $this->call('generateBlobs', $params);

        if (isset($response['error']['message'])) {
            throw new Exception($response['error']['message']);
        }

        $result = array();
        if (isset($response['result']['random']['data'])) {
            $result = $response['result']['random']['data'];
        }
        return $result;
    }

    /**
     * This method returns information related to the the
     * usage of a given API key.
     *
     * @param type $apiKey (optional) Your API key,
     * which is used to track the true random bit usage for your client.
     *
     * @return array
     * @throws Exception
     */
    public function getUsage($apiKey = null)
    {
        $params = array();

        if ($apiKey === null) {
            $apiKey = $this->apiKey;
        }
        $params['apiKey'] = $apiKey;

        $response = $this->call('getUsage', $params);

        if (isset($response['error']['message'])) {
            throw new Exception($response['error']['message']);
        }

        $result = array();
        if (isset($response['result'])) {
            $result = $response['result'];
        }

        return $result;
    }

    /**
     * Set endpoint URL
     *
     * @param string $url url
     */
    protected function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Set time limit
     *
     * @param int $timeLimit
     */
    protected function setTimelimit($timeLimit)
    {
        $this->timeLimit = $timeLimit;
        set_time_limit($this->timeLimit);
    }

    /**
     * Http Json-RPC Request ausfuehren
     *
     * @param string $method
     * @param array $params
     * @return array
     */
    protected function call($method, $params = null, $randomID = null)
    {
        if(empty($randomID))
            $randomID = mt_rand(1, 999999);
        $request = array();
        $request['jsonrpc'] = '2.0';
        $request['id'] = $randomID;
        $request['method'] = $method;
        if (isset($params)) {
            $request['params'] = $params;
        }

        $json = $this->encodeJson($request);
        $responseData = $this->post($json);
        $response = $this->decodeJson($responseData);
        return $response;
    }

    /**
     * HTTP POST-Request
     *
     * @param string $content content data
     * @return string
     */
    protected function post($content = '')
    {
        $defaults = array(
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_URL => $this->url,
            CURLOPT_FRESH_CONNECT => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FORBID_REUSE => 1,
            CURLOPT_TIMEOUT => $this->timeLimit,
            CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
            CURLOPT_POSTFIELDS => $content,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => false
        );

        $ch = curl_init();
        curl_setopt_array($ch, $defaults);

        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($httpCode < 200 || $httpCode >= 300) {
            $errorCode = curl_errno($ch);
            $errorMsg = curl_error($ch);
            $text = trim(strip_tags($result));
            curl_close($ch);
            throw new Exception(trim("HTTP Error [$httpCode] $errorMsg. $text"), $errorCode);
        }

        curl_close($ch);
        return $result;
    }

    /**
     * Json encoder
     *
     * @param array $array
     * @param int $options
     * @return string
     */
    protected function encodeJson($array, $options = 0)
    {
        return json_encode($this->encodeUtf8($array), $options);
    }

    /**
     * Json decoder
     *
     * @param string $strJson
     * @return array
     */
    protected function decodeJson($strJson)
    {
        return json_decode($strJson, true);
    }

    /**
     * Encodes an ISO string to UTF-8
     *
     * @param mixed $str
     * @return mixed
     */
    protected function encodeUtf8($str)
    {
        if ($str === null || $str === '') {
            return $str;
        }

        if (is_array($str)) {
            foreach ($str as $key => $value) {
                $str[$key] = $this->encodeUtf8($value);
            }
            return $str;
        } else {
            if (!mb_check_encoding($str, 'UTF-8')) {
                return mb_convert_encoding($str, 'UTF-8');
            } else {
                return $str;
            }
        }
    }
}