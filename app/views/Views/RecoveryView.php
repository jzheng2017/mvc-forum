<?php


class RecoveryView extends View
{
    public $password;
    public $confirm;
    public $code;
    public $valid;

    public function __construct()
    {
        parent::__construct();
        $this->valid = false;
    }
}