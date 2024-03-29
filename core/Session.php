<?php


class Session
{
    private function __construct()
    {
        //can not be instantiated
    }

    public static function exists($session){
        return (isset($_SESSION[$session])) ? true : false;
    }

    public static function get($session){
        return self::exists($session) ? $_SESSION[$session] : self::set($session, NULL);
    }

    public static function set($session, $value){
        return $_SESSION[$session] = $value;
    }

    public static function delete($session){
        if (self::exists($session)){
            unset($_SESSION[$session]);
        }
    }

    public static function useragent_no_version(){
        $useragent = $_SERVER['HTTP_USER_AGENT'];
        $regex = '/\/[a-zA-Z0-9.]+/';
        $useragent = preg_replace($regex, '', $useragent);
        return $useragent;
    }
}