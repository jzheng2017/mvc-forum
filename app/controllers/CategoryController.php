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

    public function viewAction($id = -1, $page = 1)
    {
        Log::logAction('Category', 'View', $id);

        $category = new CategoryModel((int)$id);
        $category->exists() ? "" : Router::redirect('error');
        $this->view->category = $category;

        $db = Database::getInstance();

        $limit = 10;
        $count = count($db->query(Query::get('get_threads'), [$id])->result());

        $maxPage = ceil($count / $limit);
        $maxPage = $maxPage < 1 ? 1 : $maxPage;
        if ($page < 1){
            Router::redirect('category/view/'.$id.'/1');
        } else if ($page > $maxPage){
            Router::redirect('category/view/'.$id.'/'.$maxPage);
        }

        $offset = $page == 1 ? 0 : ($page - 1) * $limit;

        $thread = new ThreadModel();
        $this->view->threads = $thread->getAll($id, true, $offset, $limit);

        $this->view->currentPage = $page;
        $this->view->maxPage = $maxPage;

        $this->view->render("category/category_detail");
    }



}