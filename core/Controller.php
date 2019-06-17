<?php

class Controller extends Application
{
    protected $controller;
    protected $action;
    public $view;

    public function __construct($controller, $action)
    {
        parent::__construct();
        $this->controller = $controller;
        $this->action = $action;
        $this->view = new View();
    }

    public function load_model($model)
    {
        if (class_exists($model)) {
            $this->{$model} = new $model(strtolower($model));
        }
    }


}