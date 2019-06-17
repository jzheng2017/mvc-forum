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
        Router::redirect('');
    }

    public function registrationAction()
    {
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
                'first_name' => [
                    'display' => 'First name',
                    'required' => true
                ],
                'last_name' => [
                    'display' => 'Lat name',
                    'required'=> true
                ],
                'street'=>[
                    'display' => 'Street',
                    'required' => true
                ],
                'street_nr' => [
                    'display' => 'Street number',
                    'required' => true,
                    'is_numeric' => true
                ],
                'zipcode'=>[
                    'display' => 'Zipcode',
                    'required'=>true
                ],
                'country'=>[
                    'display' => 'Country',
                    'required'=> true
                ]
            ]);
            if ($validation->passed()) {
                $user = new UserModel();
                $user->registration($_POST);
            } else {
                $this->view->errors = $validation->displayErrors();
            }
        }
        $this->view->fields = $_POST;
        $this->view->render('user/registration');
    }

    public function loginAction()
    {
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

                if (password_verify(Input::get('password'), $user->password)) {
                    $remember = (isset($_POST['remember']) && Input::get('remember')) ? true : false;
                    $user->login($remember);
                    Router::redirect('');
                }

            } else {
                $this->view->errors = $validation->displayErrors();
            }
        }

        $this->view->render('user/login');
    }

    public function logoutAction()
    {
        if (UserModel::currentLoggedInUser()) {
            UserModel::currentLoggedInUser()->logout();
            Router::redirect('user/login');
        } else {
            Router::redirect('error/logout');
        }
    }

    public function profileAction()
    {
        $this->view->render('user/profile');
    }
}