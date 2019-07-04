<?php


class ActionController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    public function indexAction()
    {
        $this->view->render('');
    }

    public function removeAction($type = '', $id = -1)
    {
        $this->view->action = str_replace("Action", "", $this->action);
        Log::logAction(ucwords($type), ucwords($this->view->action), $id);
        $this->view->type = $type;
        $model = new ActionModel();
        $model->params = [$type, $this->view->action, $id];
        if (!$model->exists()) {
            if (UserModel::currentLoggedInUser()->permission > 0) {
                if (count($_POST)) {
                    $validation = new Validate();
                    $validation->validate($_POST, [
                        'comment' => [
                            'display' => 'Comment',
                            'max' => 255,
                            'required' => true
                        ]
                    ]);

                    if ($validation->passed()) {
                        $model->deleteObject(); //deletes the relevant object (example: thread or post)
                        $model->type = $type;
                        $model->action = $this->view->action;
                        $model->object_id = $id;
                        $model->comment = Input::get('comment');
                        $model->user_id = UserModel::currentLoggedInUser()->id;
                        $model->save();
                        $model->exists();
                        $this->view->model = $model->resultModel; //returns the inserted values in a model object
                    } else {
                        $this->view->errors = $validation->displayErrors();
                    }
                }
            }
        } else {
            $this->view->model = $model->resultModel;
        }

        $this->view->object = $type == 'thread' ? new ThreadModel((int)$id) : new PostModel((int)$id); // get the relevant object from the database based on the id
        !$this->view->object->exists() ? Router::redirect('error') : ""; //if the object does not exist then redirect to error page
        $this->view->render('actions/user_thread_action');
    }

    public function reportAction($type = '', $id = -1){
        $this->view->action = str_replace("Action", "", $this->action);
        Log::logAction(ucwords($type), ucwords($this->view->action), $id);
        $this->view->type = $type;
        $model = new ActionModel();
        $model->params = [$type, $this->view->action, $id];

        if (!$model->exists()){
            if (UserModel::currentLoggedInUser()->permission > 0) {

                if (count($_POST)) {

                    $validation = new Validate();
                    $validation->validate($_POST, [
                        'comment' => [
                            'display' => 'Comment',
                            'max' => 255,
                            'required' => true
                        ]
                    ]);

                    if ($validation->passed()) {
                        $model->type = $type;
                        $model->action = $this->view->action;
                        $model->object_id = $id;
                        $model->comment = Input::get('comment');
                        $model->user_id = UserModel::currentLoggedInUser()->id;
                        $model->save();
                        $model->exists();
                        $this->view->model = $model->resultModel; //returns the inserted values in a model object
                    } else {
                        $this->view->errors = $validation->displayErrors();
                    }
                }
            }

        } else {
            $this->view->model = $model->resultModel;
        }
        $this->view->object = $type == 'thread' ? new ThreadModel((int)$id) : new PostModel((int)$id); // get the relevant object from the database based on the id
        !$this->view->object->exists() ? Router::redirect('error') : ""; //if the object does not exist then redirect to error page
        $this->view->render('actions/user_thread_action');
    }
}