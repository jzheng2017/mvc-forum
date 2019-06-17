<?php


class Query
{
    private function __construct()
    {
        //so this class can not be instantiated
    }

    public static function get($query){
        return file_get_contents(ROOT . DS . 'app' . DS . 'queries'. DS . $query . ".sql");
    }
}