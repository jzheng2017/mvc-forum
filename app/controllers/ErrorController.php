<?php


class ErrorController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);

    }

    public function indexAction()
    {
        Log::logAction('Error', '404', '-1');
        $this->view->render('error/404');
    }

    public function logoutAction()
    {
        Log::logAction('Error', 'Logout', '-1');
        $this->view->render('error/not_logged_in');
    }

    public function userAction(){
        Log::logAction('Error', 'User', -1);
        $this->view->render('error/user_not_found');
    }

    public function existsAction(){
        Log::logAction('Error', 'Exists', -1);
        $this->view->render('error/exists');
    }

}