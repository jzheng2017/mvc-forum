<?php

class Home extends Controller
{

    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    public function indexAction()
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM users";
        $fields = [
            'username' => 'normaluser',
            'password' => 'test',
            'first_name' => 'john',
            'last_name' => 'doe',
            'email' => 'johndoe@hotmail.com',
            'street' => 'johnstreet',
            'street_nr' => '69',
            'zipcode' => '69691',
            'city' => 'arnhem',
            'country' => 'the Netherlands',
            'permission' => '2'
        ];
        $this->view->render('home/index');
    }
}