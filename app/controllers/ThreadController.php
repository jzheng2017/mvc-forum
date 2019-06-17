<?php


class ThreadController extends Controller
{

    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);

    }

    public function indexAction()
    {
        Router::redirect('');
    }

    public function viewAction($id)
    {
        if ($_POST && UserModel::currentLoggedInUser()) {
            if (time() - Session::get('last_posted') > 60) { //checks if the user has posted in the last minute
                $post = new PostModel();
                $post->body = $_POST['body'];
                $post->user_id = UserModel::currentLoggedInUser()->id;
                $post->thread_id = $id;
                $post->save();
                Session::set('last_posted', time());
                Router::redirect('thread/view/' . $id);
            } else {
                if (Session::get('last_posted')) {
                    $this->view->errors[] = "You have to wait " . ((Session::get('last_posted') - time()) + 60) . " second(s) to post again.";
                } else {
                    $this->view->errors[] = "You have posted in the last 60 seconds, wait a bit before posting again.";
                }
            }
        }
        $this->load_model('ThreadModel');
        $this->view->thread = $this->ThreadModel->findById($id);
        !empty($this->view->thread->id) ? "" : Router::redirect('error'); // if thread doesn't exist
        $this->view->thread->getUser(); //gets original poster of the thread
        $this->view->thread->getPosts(); //gets all posts from the specific thread
        $this->view->render("thread/thread_detail");
    }

    public function createAction(){
        $categories = new CategoryModel();
        $this->view->categories = $categories->getAll();
        $this->view->render('thread/create_thread');
    }

    public function delete($action, $id){
        if ($_POST && UserModel::currentLoggedInUser()->permission > 1) {
            if ($action == 'post') {
                $model = new PostModel();
                $model->delete($id);
            } else if ($action == 'thread') {

            }
        }
    }
}