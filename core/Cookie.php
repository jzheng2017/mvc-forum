<?php


class Cookie
{

    private function __construct()
    {
        //can not be instantiated
    }

    public static function set($cookie, $value, $expiry)
    {
        if (setcookie($cookie, $value, (int)(time() + $expiry), '/')) {
            return true;

        }
        return false;
    }

    public static function delete($cookie)
    {
        self::set($cookie, '', -1);
    }

    public static function get($cookie)
    {
        return $_COOKIE[$cookie];
    }

    public static function exists($cookie)
    {
        return isset($_COOKIE[$cookie]);
    }
}