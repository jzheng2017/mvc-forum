<?php


class RestrictedController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    public function indexAction()
    {
        Log::logAction('Restricted', 'Index', -1);
        $this->view->render('restricted/index');
    }
}