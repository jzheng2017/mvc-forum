<?php


class ErrorController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);

    }

    public function indexAction()
    {
        $this->view->render('error/404');
    }

    public function logoutAction()
    {
        $this->view->render('error/not_logged_in');
    }

}