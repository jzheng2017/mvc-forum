<?php


class MailService
{

    private $vars = [];

    private $template;

    public function __construct($template)
    {
        $this->template = PROOT . DS . 'app' . DS . 'views'. DS . 'mail' . $template . ".php";
    }

    private function renderMessage()
    {
        ob_start();
        include $this->template;
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
    }

    public function addVar($key, $value)
    {
        $this->vars[$key] = $value;
    }

    public function getVar($key) {
        return isset($this->vars[$key]) ? $this->vars[$key] : false;
    }

    public function sendMail($to, $subject){
        $message = $this->renderMessage();

        $header = "MIME-Version: 1.0" . "\r\n";
        $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        if (!mail($to, $subject, $message, $header)) {
            return false;
        }
        return true;

    }
}