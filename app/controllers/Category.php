<?php


class Category extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }


    public function indexAction(){
        $this->view->render("category/category_all");
    }
    public function viewAction($id = -1){
        $this->view->render("category/category_detail");
    }

}