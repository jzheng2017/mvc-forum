<?php


class Thread extends Controller
{

    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    public function indexAtion(){
        $this->view->render();
    }

    public function viewAction(){
        $this->view->render("thread/thread_detail");
    }
}