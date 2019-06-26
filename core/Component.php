<?php


class Component
{
    public $body;

    public function __construct($component)
    {
        $filePath = ROOT . DS . 'app' . DS . 'components'. DS . 'views' . DS . $component . ".php";
        if (file_exists($filePath)){
        ob_start();
        require_once($filePath);
        $this->body = ob_get_clean();
        }else{
            $this->body = "Contents could not be loaded, check if file exists: " . $filePath;
        }
    }

    public function render(){
        return $this->body;
    }
}