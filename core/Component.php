<?php


class Component
{

    private function __construct()
    {
        //cannot be instantiated
    }

    public static function get($component){
        require_once(ROOT . DS . 'app' . DS . 'components'. DS . $component . ".php");
    }
}