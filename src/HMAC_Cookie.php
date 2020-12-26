<?php


class HMAC_Cookie
{
    private $key = 2137;
    public function encryptCookieData($cookieData)
    {
        $hmac = hash_hmac('sha256', $cookieData, $this->key);
        $encryptedCookieData = $hmac.$cookieData;

        return $encryptedCookieData;
    }

    public function decryptCookieData($cookieName)
    {
        $hmacReceived = substr($_COOKIE[$cookieName], 0, 64);
        $dataReceived = substr($_COOKIE[$cookieName], 64);
        $hmacComputed = hash_hmac('sha256', $dataReceived, $this->key);

        if (hash_equals($hmacComputed, $hmacReceived))
        {
            return [true, $dataReceived];
        }
        else
        {
            return [false, $dataReceived]; //modified cookie data
        }
    }
}