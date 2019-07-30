<?php


class ThreadController extends Controller
{

    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    public function indexAction()
    {
        Log::logAction('Thread', 'Index', -1);
        Router::redirect('');
    }

    public function viewAction($id = -1)
    {
        Log::logAction('Thread', 'View', $id);
        $this->load_model('ThreadModel');
        $this->view->thread = $this->ThreadModel->findById($id);
        !empty($this->view->thread->id) ? "" : Router::redirect('error'); // if thread doesn't exist
        if (isset($_POST['insert']) && UserModel::currentLoggedInUser()->permission >= 0) {
            $validation = new Validate();
            $last_posted = Util::lastAction('thread_post');
            $last_posted = $last_posted ? strtotime($last_posted->date_created) : 0;
            if (time() - $last_posted > 60) { //checks if the user has posted in the last minute
                $validation->validate($_POST, [
                    'body' => [
                        'display' => 'Post',
                        'max' => 2700,
                        'min' => 69
                    ]
                ]);
                if ($validation->passed()) {
                    $post = new PostModel();
                    $post->body = Input::get('body');
                    $post->user_id = UserModel::currentLoggedInUser()->id;
                    $post->thread_id = $id;
                    $post->save();
                    Router::redirect('thread/view/' . $id);
                } else {
                    $this->view->errors = $validation->displayErrors();

                }
            } else {

                $validation->addError("You have to wait " . (($last_posted - time()) + 60) . " second(s) to post again.");
                $this->view->errors = $validation->displayErrors();

            }
        } else if (isset($_POST['status']) && UserModel::currentLoggedInUser()->permission > 0) { //change thread status to open or closed depending on the current status
            $this->view->thread->closed = !$this->view->thread->closed;
            $this->view->thread->save();
        } else if (isset($_POST['important']) && UserModel::currentLoggedInUser()->permission > 1) { //change thread status to open or closed depending on the current status
            $this->view->thread->important = !$this->view->thread->important;
            $this->view->thread->save();
        }
        $this->view->thread->getUser(); //gets original poster of the thread
        $this->view->thread->getPosts(); //gets all posts from the specific thread
        $this->view->render("thread/thread_detail");
    }

    public function createAction($id = -1)
    {
        Log::logAction('Thread', 'Create', $id);
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
                    'min' => 69,
                    'max' => 2800
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
                Router::redirect($model->generateUrl());
            } else {
                $this->view->errors = $validation->displayErrors();
            }
            $this->view->fields = $_POST;
        }
        $categories = new CategoryModel();
        $this->view->categories = $categories->getAll();
        $this->view->id = $id;
        $this->view->render('thread/create_thread');
    }

    public function editAction($thread = -1, $post = -1)
    {

       if ($thread == -1){
           Log::logAction('Thread', 'Edit', $thread);
           Router::redirect('error');
       }

        $model = $thread > -1 && ($post == -1 || $post == '')? new ThreadModel((int)$thread) : new PostModel((int)$post);

        if ($model->exists() && $model->deleted == 0) {
            if ($model instanceof ThreadModel){
                Log::logAction('Thread', 'Edit', $thread);
                !($model->created_by == UserModel::currentLoggedInUser()->id) ? Router::redirect('error') : "";

            } else if ($model instanceof PostModel){

                Log::logAction('Post','Edit', $post);
                !($model->user_id == UserModel::currentLoggedInUser()->id) ? Router::redirect('error') : "";
            }

            if ($_POST){
                $validation = new Validate();
                $validation->validate($_POST,[
                   'body' => [
                       'display' => 'Content',
                       'min' => 69,
                       'max' => 2800,
                       'required' => true
                   ]
                ]);

                if ($validation->passed()){
                    $model->body = Input::get('body');
                    $model->save();
                    Router::redirect('thread/view/'.$thread);
                }else{
                    $this->view->errors = $validation->displayErrors();
                }
            }
        } else {
            Router::redirect('error');
        }

        $this->view->model = $model;
        $this->view->render('thread/edit');
    }
}