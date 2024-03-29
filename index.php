<?php


define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

//load config and helper functions
require_once(ROOT . DS . 'config' . DS . 'config.php');
require_once(ROOT . DS . 'app' . DS . 'libs' . DS . 'helpers' . DS . 'functions.php');

// autoload classes
function autoload($className)
{
    $core = ROOT . DS . 'core' . DS . $className . '.php';
    $controller = ROOT . DS . 'app' . DS . 'controllers' . DS . $className . '.php';
    $model = ROOT . DS . 'app' . DS . 'models' . DS . $className . '.php';
    $component = ROOT . DS . 'app' . DS . 'components' . DS . $className . '.php';
    $view = ROOT . DS . 'app' . DS . 'views' . DS . 'Views' . DS . $className . '.php';

    if (file_exists($core)) {
        require_once($core);
    } else if (file_exists($controller)) {
        require_once($controller);
    } else if (file_exists($model)) {
        require_once($model);
    } else if (file_exists($component)) {
        require_once($component);
    } else if (file_exists($view)) {
        require_once($view);
    }
}

spl_autoload_register('autoload');

session_start();

// Route the request
$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : [];

$db = Database::getInstance();

if (!Session::exists(CURRENT_USER_SESSION_NAME) && Cookie::exists(REMEMBER_ME_COOKIE)) {
    UserModel::loginUserFromCookie();
}
Router::route($url);