<?php

class IndexController extends Controller
{

    public function __construct($controller, $action)
    {

        parent::__construct($controller, $action);
    }

    public function indexAction()
    {
        Log::logAction('Index', '', -1);
        $this->load_model('CategoryModel');
        $db = Database::getInstance();
        $this->view->categories = $this->CategoryModel->getAll();
        $this->view->render('home/index');
    }
}