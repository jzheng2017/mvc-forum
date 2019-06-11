<?php


class Cookie
{

    public static function set($cookie, $value, $expiry)
    {
        if (setcookie($cookie, $value, time() + $expiry, '/')) {
            return true;
        }
        return false;
    }

    public static function delete($cookie)
    {
        self::set($cookie, '', time() - 1);
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