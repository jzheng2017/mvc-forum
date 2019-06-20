<?php


class ACL
{
    private function __construct()
    {
        //can not be instantiated
    }

    public static function hasAccess($controller, $action = 'index')
    {
        $acl_file = self::get('acl');
        $acl = json_decode($acl_file, true);

        $current_user_acl = "Guest";
        $grantAccess = false;
        if (Session::exists(CURRENT_USER_SESSION_NAME)) {
            $current_user_acl = ucwords(UserModel::currentLoggedInUser()->role);
        }
        $controller = str_replace('Controller', '', $controller);
        $action = str_replace('Action', '', $action);

        if (array_key_exists($current_user_acl, $acl) && array_key_exists($controller, $acl[$current_user_acl])) {
            if (in_array($action, $acl[$current_user_acl][$controller]) || in_array("*", $acl[$current_user_acl][$controller])) {
                $grantAccess = true;
            }

        }

        $denied = $acl[$current_user_acl]['denied'];

        if (!empty($denied) && array_key_exists($controller, $denied) && in_array($action, $denied[$controller])) {

            $grantAccess = false;
        }

        return $grantAccess;
    }

    public static function get($file)
    {
        return file_get_contents(ROOT . DS . 'app' . DS . $file . '.json');
    }

}