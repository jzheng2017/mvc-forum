<?php


class Log
{
    private function __construct()
    {
        //can not be instantiated
    }

    public static function logAction($type, $action, $object_id)
    {
        $db = Database::getInstance();
        $data = [];

       isset($_SERVER['PATH_INFO']) ? Session::set('path_link', $_SERVER['PATH_INFO']) : Session::set('path_link', "index");
        $user = isset(UserModel::currentLoggedInUser()->id) ? UserModel::currentLoggedInUser()->id : -1;
        isset($_POST) ? $data = json_encode($_POST) : $data = json_encode($_GET);
        $db->insert('user_log', ['type' => $type, 'action' => $action, 'object_id' => $object_id, 'user_id' => $user, 'user_ip' => self::getIPAddress(), 'session_data' => json_encode($_SESSION), 'data' => $data]);
    }

    private static function getIPAddress()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];

        }
        return $ip;
    }
}