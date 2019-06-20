<?php

class Router
{

    public static function route($url)
    {

        //controller
        $controller = (isset($url[0]) && $url[0] != '') ? ucwords($url[0]) : DEFAULT_CONTROLLER;
        $controller .= "Controller";
        $controller_name = $controller;
        array_shift($url);

        //action
        $action = (isset($url[0]) && $url[0] != '') ? $url[0] . 'Action' : 'indexAction';
        $action_name = $action;
        array_shift($url);

        //acl check
        $grantAccess = ACL::hasAccess($controller_name, $action_name);

        if (!$grantAccess){
            $controller_name = $controller = ACCESS_RESTRICTED;
            $action = 'indexAction';
        }

        //params
        $queryParams = $url;
        if (class_exists($controller)) {
            $dispatch = new $controller($controller_name, $action);

            if (method_exists($controller, $action)) {
                call_user_func_array([$dispatch, $action], $queryParams);
            } else {
                self::redirect('error');
                // die('That method does not exist in the controller \"' . $controller_name . '\"');
            }
        } else {
            self::redirect('error');
        }

    }

    public static function redirect($location)
    {
        if (!headers_sent()) {
            header('Location: ' . PROOT . $location);
            exit();
        } else {
            echo '<script type="text/javascript">';
            echo 'window.location.href="' . PROOT . $location . '"';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url=' . $location . '"/>';
            echo '</noscript>';
            exit();
        }
    }

}