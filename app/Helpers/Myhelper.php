<?php

namespace App\Helpers;

use GuzzleHttp\Client;
//use GuzzleHttp\Exception\RequestException;
//use GuzzleHttp\Exception\GuzzleException;
//use GuzzleHttp\Psr7\Request;
//use GuzzleHttp\Psr7\Response;
use Carbon\Carbon;
use Session;

/**
 * Class for Application Common Functions
 *
 * @category  Class
 * @package   SiteHelpers
 * @author     Ramesh Pandi <ramesh.pandi@emeriocorp.com>
 * @copyright 2006-2018 Emerio Technologies Pvt Ltd
 * @link      Link
 */

class Myhelper
{
    public static function httpRequest($request, $apiMethod, $apiPathName, $data, $authorization = 0)
    {
        $httpRequest = new Client(['http_errors' => false, 'verify' => false]);
        
        $headerData = array();
        $headerData['Content-Type'] = "application/json";
        if ($authorization === 1) {
            $headerData['Authorization'] = 'Bearer ' . Session::get('token');
        }
        $httprequest = $httpRequest->request($apiMethod, $apiPathName, ['headers' => $headerData, 'body' => $data]);   
        return $httprequest;
    }

    public static function getLoginToken($request, $tokenRequestData)
    {
        /* 
            to get the token path, use the command - php artisan route:list
            where you install the passport
        */
        $tokenPath = "http://localhost/PassportApplication/backEnd/oauth/token";
        $tokenResponse = static::httpRequest($request, 'POST', $tokenPath, json_encode($tokenRequestData));
        return $tokenResponse;
    }
}

