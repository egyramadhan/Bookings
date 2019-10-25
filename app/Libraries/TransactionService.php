<?php

namespace App\Libraries;

class TransactionService
{
    private static $url = 'https://api.jouska.financial/api/';

    public static function methodlogin($email, $password)
    {
        $url = self::$url . 'login?email'. $email . '&password' . $password;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('email' => $email, 'password' => $password));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__) . '(cookie cracker yummy)');
        curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__) . '(cookie cracker yummy)');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_TIMEOUT, (120));
        $response = curl_exec($ch);
        $header = curl_getinfo($ch);
        $error_no = curl_errno($ch);
        $error = curl_error($ch);
        curl_close($ch);
        if ($error_no != 200) { }

        $body = json_decode($response, true);
        if (JSON_ERROR_NONE == json_last_error()) { }
        return [
            'error' => false,
            'message' => $body,
        ];
    }

    public static function login($email, $password)
    {
        $url = self::$url . 'login?email' . $email . '&password=' . $password;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('email' => $email, 'password' => $password));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        // common description bellow
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__) . '(cookie cracker yummy)');
        curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__) . '(cookie cracker yummy)');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_TIMEOUT, (120));
        $response = curl_exec($ch);
        $header = curl_getinfo($ch);
        // 200? 404? or something?
        $error_no = curl_errno($ch);
        $error = curl_error($ch);
        curl_close($ch);
        if ($error_no != 200) {
            // do something for login error
            // return or exit
        }
        $body = json_decode($response, true);
        if (JSON_ERROR_NONE == json_last_error()) {
            // $response is not valid (as JSON)
            // do something for login error
            // return or exit
        }
        // dd($body);
        return $response;
        // use $body
    }

    public static function getUser(Request $request, $token)
    {
        static::login($username, $password);

    }
}
