<?php


class CategoryController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);


    }


    public function indexAction()
    {
        Log::logAction('Category', 'Index', -1);
        Router::redirect('');
    }

    public function viewAction($id = -1)
    {
        Log::logAction('Category', 'View', $id);
        $this->load_model("CategoryModel");
        $this->load_model('ThreadModel');
        $this->view->category = $this->CategoryModel->findById($id);
        !empty($this->view->category->id) ? "" : Router::redirect('error');
        $this->view->threads = $this->ThreadModel->getAll($id);
        $this->view->render("category/category_detail");
    }



}