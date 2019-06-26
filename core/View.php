<?php

class View
{
    protected $head;
    protected $body;
    protected $siteTitle = SITE_TITLE;
    protected $outputBuffer;
    protected $layout = DEFAULT_LAYOUT;

    public $errors;

    public function __construct()
    {
    }

    public function render($viewName)
    {
        $viewArray = explode('/', $viewName);
        $viewString = implode(DS, $viewArray);
        if (file_exists(ROOT . DS . 'app' . DS . 'views' . DS . $viewString . '.php')) {
            include(ROOT . DS . 'app' . DS . 'views' . DS . $viewString . '.php');
            include(ROOT . DS . 'app' . DS . 'views' . DS . 'layouts' . DS . $this->layout . '.php');
        } else {
            //die('The view \"' . $viewName . '\" does not exist.');
            Router::redirect('error');
        }
    }

    public static function renderComponent(Component $component){
        return $component->render();
    }

    public function content($type)
    {
        if ($type == 'head') {
            return $this->head;
        } else if ($type == 'body') {
            return $this->body;
        }
        return false;
    }




    public function start($type)
    {
        $this->outputBuffer = $type;
        ob_start();
    }

    public function end()
    {
        if ($this->outputBuffer == 'head') {
            $this->head = ob_get_clean();
        } else if ($this->outputBuffer == 'body') {
            $this->body = ob_get_clean();
        } else {
            die('You must first run the start method');
        }
    }

    public function getSiteTitle()
    {
        return $this->siteTitle;
    }

    public function setSiteTitle($title)
    {
        $this->siteTitle = $title;
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

}
