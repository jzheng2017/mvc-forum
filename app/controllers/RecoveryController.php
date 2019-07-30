<?php


class RecoveryController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }


    public function indexAction()
    {
        if ($_POST) {
            $validation = new Validate();
            $validation->validate($_POST, [
                'identifier' => [
                    'display' => 'Input',
                    'min' => '3',
                    'required' => true
                ]
            ]);
            
            if ($validation->passed()) {
                $user = Util::getByUsernameEmail(Input::get('identifier'));

                if (!$user) {
                    $validation->addError('Username or email does not exist.');
                    $this->view->errors = $validation->displayErrors();
                } else {
                    $model = new UserCodeModel();
                    $existingCode = $model->findFirst(['conditions' => ['user_id = ?', 'type = ?'], 'bind' => [$user->id, 'recovery']]);
                    if ($existingCode->exists()) {
                        $existingCode->update($existingCode->id, ['code' => Util::generateCode()]);
                    } else {
                        $model->type = 'recovery';
                        $model->code = Util::generateCode();
                        $model->user_id = $user->id;
                        $model->save();
                        Router::redirect('recovery/code');
                    }
                }
            } else {
                $this->view->errors = $validation->displayErrors();
            }
        }
        $this->view->render('recovery/forgotpassword');
    }

    public function codeAction($code = '')
    {
        $this->view = new RecoveryView();
        $this->view->code = $code;

        if ($_POST) {
            $validation = new Validate();
            $validation->validate($_POST, [
                'code' => [
                    'display' => 'Code',
                    'required' => true
                ]
            ]);

            if ($validation->passed()) {
                $model = new UserCodeModel();
                $model = $model->findByCode(Input::get('code'));
                if ($model->exists()) {
                    Router::redirect('recovery/change_password/' . $model->code);
                } else {
                    $validation->addError('The code is not valid.');
                    $this->view->errors = $validation->displayErrors();
                }
            } else {
                $this->view->errors = $validation->displayErrors();
            }
        }
        $this->view->render('recovery/account_recovery');
    }

    public function change_passwordAction($code = '')
    {
        $this->view = new RecoveryView();

        $code == '' ? Router::redirect('recovery/code') : "";

        $model = new UserCodeModel();
        $model = $model->findByCode($code);

        $validation = new Validate();

        if ($model->exists()) {
            $this->view->valid = true;
            if ($_POST) {
                $validation->validate($_POST, [
                    'password' => [
                        'display' => 'Password',
                        'required' => true,
                        'min' => 8,
                        'has_uppercase' => true
                    ],
                    'confirm_password' => [
                        'display' => 'Confirm password',
                        'required' => true,
                        'matches' => 'password'
                    ]
                ]);

                if ($validation->passed()) {
                    $model->getUser();
                    if ($model->user->exists()) {
                        $model->user->password = password_hash(Input::get('password'), PASSWORD_DEFAULT);
                        $model->user->save();
                        $model->delete($model->id);
                        Router::redirect('user/login');
                    }
                } else {
                    $this->view->errors = $validation->displayErrors();
                }
            }
        } else {
            $validation->addError('The code does not exist in our database');
            $this->view->errors = $validation->displayErrors();
        }
        $this->view->render('recovery/change_password');
    }
}