<?php

class UserController extends Controller
{

    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->view->setLayout('default');

    }

    public function indexAction()
    {
        Log::logAction('User', 'Index', -1);
        Router::redirect('');
    }

    public function registrationAction()
    {
        Log::logAction('User', 'Registration', -1);
        $model = new CountryModel();
        $model->getAll();
        $this->view->countries = $model->countries;
        if ($_POST) {
            $validation = new Validate();
            $validation->validate($_POST, [
                'username' => [
                    'display' => 'Username',
                    'required' => false,
                    'min' => 3,
                    'max' => 30,
                    'unique' => 'users'
                ], 'password' => [
                    'display' => 'Password',
                    'required' => true,
                    'min' => 8,
                    'has_uppercase' => true
                ],
                'confirm_password' => [
                    'display' => 'Confirm password',
                    'required' => true,
                    'matches' => 'password'
                ],
                'email' => [
                    'display' => 'Email',
                    'required' => true,
                    'unique' => 'users',
                    'valid_email' => true
                ],
                'confirm_email' => [
                    'display' => 'Confirm email',
                    'required' => true,
                    'matches' => 'email'
                ],
                'country' => [
                    'display' => 'Country',
                    'required' => true
                ]
            ]);
            if ($validation->passed()) {
                $user = new UserModel();
                $user->registration($_POST);
                Router::redirect('user/login');
            } else {
                $this->view->errors = $validation->displayErrors();
            }
        }
        $this->view->fields = $_POST;
        $this->view->render('user/registration');
    }

    public function loginAction()
    {
        Log::logAction('User', 'Login', -1);
        $this->load_model('UserModel');

        if ($_POST) {
            //form validation
            $validation = new Validate();
            $validation->validate($_POST, [
                'username' => [
                    'display' => "Username",
                    'required' => true
                ],
                'password' => [
                    'display' => 'Password',
                    'required' => true
                ]
            ]);

            if ($validation->passed()) {
                $user = $this->UserModel->findByUsername($_POST['username']);
                if ($user->id) {
                    if (password_verify(Input::get('password'), $user->password)) {
                        $remember = (isset($_POST['remember']) && Input::get('remember')) ? true : false;
                        $user->login($remember);
                        $points = new UserPointsModel((int)$user->id);
                        $points->assignPoints(1, "Daily login");
                        Router::redirect('');
                    } else {
                        $validation->addError("Username or password is incorrect.");
                        $this->view->errors = $validation->displayErrors();
                    }
                } else {
                    $validation->addError("Username or password is incorrect.");
                    $this->view->errors = $validation->displayErrors();
                }

            } else {
                $this->view->errors = $validation->displayErrors();
            }
        }

        $this->view->render('user/login');
    }

    public function logoutAction()
    {
        Log::logAction('User', 'Logout', -1);
        if (UserModel::currentLoggedInUser()) {
            UserModel::currentLoggedInUser()->logout();
            Router::redirect('user/login');
        } else {
            Router::redirect('error/logout');
        }
    }

    public function profileAction($id = -1)
    {
        Log::logAction('User', 'Profile', $id);
        $id = $id == '' ? $id = -1 : $id; //force '' to -1
        $id = $id == -1 ? UserModel::currentLoggedInUser()->id : $id;
        $model = new UserModel((int)$id);
        if ($model->exists()){
            $model->getUserInfo($model->id);
            $this->view->model = $model;
        }
        $this->view->render('user/profile');
    }

    public function mailAction($id = -1)
    {
        Log::logAction('User', 'Mail', $id);
        $this->view->sent = false;
        if ($_POST) {
            $validation = new Validate();
            $last_message = Util::lastAction('user_message');
            $last_message = $last_message ? strtotime($last_message->date_created) : 0;
            if (time() - $last_message > 600) {
                $validation->validate($_POST, [
                    'title' => [
                        'display' => 'Title',
                        'min' => 6,
                        'max' => 255,
                        'required' => true
                    ],
                    'body' => [
                        'display' => 'Message',
                        'min' => 69,
                        'max' => 4269,
                        'required' => true
                    ]
                ]);
                if ($validation->passed()) {
                    $model = new UserMessageModel();
                    $model->title = Input::get('title');
                    $model->body = Input::get('body');
                    $model->sender = UserModel::currentLoggedInUser()->id;
                    $model->recipient = $id;
                    $model->save();
                    $this->view->title = $_POST['title'];
                    $this->view->message = $_POST['body'];
                    $this->view->sent = true;
                } else {
                    $this->view->errors = $validation->displayErrors();
                }
            } else {
                $validation->addError("You have to wait " . (($last_message - time()) + 600) . " second(s) to post again.");
                $this->view->errors = $validation->displayErrors();
            }
        }
        $model = new UserModel((int)$id);
        $model->exists() ? "" : Router::redirect('error/user');
        $this->view->model = $model;
        $this->view->render('actions/mail');
    }

    public function messageAction($id = -1)
    {
        Log::logAction('User', 'Message', $id);
        $model = new UserMessageModel((int)$id);
        (($model->recipient != UserModel::currentLoggedInUser()->id) && ($model->sender != UserModel::currentLoggedInUser()->id)) ? Router::redirect('restricted') : ""; //if you're not the sender or recipient you don't have access to this message
        if (!$model->opened && $model->recipient == UserModel::currentLoggedInUser()->id) {//change message status to opened
            $model->opened = 1;
            $model->save();
        }

        $this->view->message = $model;


        if ($_POST) {
            $validation = new Validate();
            $validation->validate($_POST, [
                'body' => [
                    'display' => 'Message',
                    'required' => true,
                    'min' => 69,
                    'max' => 2700
                ]
            ]);

            if ($validation->passed()) {
                $message = new UserMessageModel();
                $message->title = $model->title;
                $message->body = Input::get('body');
                $message->sender = UserMOdel::currentLoggedInUser()->id;
                $message->recipient = $model->sender;
                $message->save();
                Router::redirect('user/message/' . $message->getLastInsertID());
            } else {
                $this->view->errors = $validation->displayErrors();
            }
        }

        $this->view->render('user/message');
    }

    public function inboxAction($type = 'received')
    {
        Log::logAction('User', 'Inbox', -1);
        $db = Database::getInstance();

        if ($type == 'received') {
            $result = $db->find("user_messages", ["conditions" => ["recipient = ?", "deleted = ?", "favorite = ?"], "bind" => [UserModel::currentLoggedInUser()->id, 0, 0], "order" => ["date_created DESC"]]);
            $this->view->messages = $result;
        } else if ($type == 'sent') {
            $result = $db->find("user_messages", ["conditions" => ["sender = ?", "deleted = ?"], "bind" => [UserModel::currentLoggedInUser()->id, 0], "order" => ["date_created DESC"]]);
            $this->view->messages = $result;
        } else if ($type == 'trashcan') {
            $result = $db->find("user_messages", ["conditions" => ["recipient = ?", "deleted = ?"], "bind" => [UserModel::currentLoggedInUser()->id, 1], "order" => ["date_created DESC"]]);
            $this->view->messages = $result;
        } else if ($type == 'favorite') {
            $result = $db->find("user_messages", ["conditions" => ["recipient = ?", "deleted = ?", "favorite = ?"], "bind" => [UserModel::currentLoggedInUser()->id, 0, 1], "order" => ["date_created DESC"]]);
            $this->view->messages = $result;
        }
        $this->view->page = $type;
        $this->view->render('user/inbox');
    }

    public function reputationAction($id = -1)
    {
        Log::logAction('User', 'Reputation', $id);
        $id == -1 || $id == '' ? Router::redirect('error') : "";
        $this->view->user = new UserModel((int)$id);
        $this->view->reputations = (new ReputationModel())->getAll($id);
        $this->view->id = $id;
        $this->view->render('user/reputation');
    }

    public function rateAction($id = -1)
    {
        Log::logAction('User', 'Rate', $id);
        $id == -1 || $id == '' ? Router::redirect('error') : "";
        $id == UserModel::currentLoggedInUser()->id ? Router::redirect('restricted') : "";
        $this->view = new RateView();
        $this->view->user = new UserModel((int)$id);
        $this->view->user->exists() ? "" : Router::redirect('error/user');


        $rep = new ReputationModel();
        $rep = $rep->findByUserId([$id,UserModel::currentLoggedInUser()->id]);

        $this->view->reputation = $rep;

        if ($_POST) {
            $validation = new Validate();
            $validation->validate($_POST, [
                'rating' => [
                    'display' => 'Rating',
                    'required' => true
                ],
                'comment' => [
                    'display' => 'Comment',
                    'max' => 255,
                    'required' => true
                ]
            ]);
            if ($validation->passed()){
                if ($rep->exists()){
                    $model = $rep;
                }else {
                    $model = new ReputationModel();
                }
                $model->rating = Input::get('rating');
                $model->comment = Input::get('comment');
                $model->user_id = $id;
                $model->given_by = UserModel::currentLoggedInUser()->id;
                $model->save();
                Router::redirect('user/reputation/'.$id);
            }else{
                $this->view->errors = $validation->displayErrors();
            }
        }

        $this->view->render('user/rate');
    }

    public function postsAction($id = -1){
        Log::logAction('User', 'Posts', $id);
        $user = new UserModel((int)$id);
        $user->exists() ? "" : Router::redirect('error/user');
        $this->view->user = $user;
        $posts = new PostModel();
        $this->view->posts = $posts->getAllByUser($user->id);
        $this->view->render('user/posts');
    }

    public function pointsAction($id = -1){
        Log::logAction('User', 'Points', $id);
        $points = new UserPointsModel((int)$id);
        $points->exists() ? "" : Router::redirect('errors');
        $this->view->points = $points;

        $this->view->logs = $points->getLog();
        $this->view->render('user/logs');
    }
}
