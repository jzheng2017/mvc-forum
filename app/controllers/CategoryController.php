<?php


class CategoryController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);


    }


    public function indexAction()
    {
        Router::redirect('');
    }

    public function viewAction($id = -1)
    {
        $this->load_model("CategoryModel");
        $this->load_model('ThreadModel');
        $this->view->category = $this->CategoryModel->findById($id);
        !empty($this->view->category->id) ? "" : Router::redirect('error');
        $this->view->threads = $this->ThreadModel->getAll($id);
        $this->view->render("category/category_detail");
    }

    public function createAction($id)
    {
        if ($_POST) {
            $validation = new Validate();
            $validation->validate($_POST, [
                'title' => [
                    'display' => 'Title',
                    'required' => true,
                    'min' => '6'
                ],
                'body' => [
                    'display' => 'Body',
                    'required' => true,
                    'min' => 69
                ],
                'category' => [
                    'display' => 'Category',
                    'required' => true
                ]
            ]);
            if ($validation->passed()) {
                $model = new ThreadModel();
                $model->title = Input::sanitize($_POST['title']);
                $model->body = Input::sanitize($_POST['body']);
                $model->category_id = $_POST['category'];
                $model->created_by = UserModel::currentLoggedInUser()->id;
                $model->save();
            }else{
                $this->view->errors = $validation->displayErrors();
            }
            $this->view->fields = $_POST;
        }
        $categories = new CategoryModel();
        $this->view->categories = $categories->getAll();
        $this->view->id = $id;
        $this->view->render('thread/create_thread');
    }

}