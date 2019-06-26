<?php


class NavbarComponent extends Component
{
    public $inbox;

    public function __construct($component)
    {
        $this->inbox();
        parent::__construct($component);
    }

    public function inbox(){
        $db = Database::getInstance();
        $result = $db->find("user_messages", ["conditions" => ["recipient = ?", "opened = ?" ,"deleted = ?"], "bind" => [UserModel::currentLoggedInUser()->id, 0, 0], "order" => ["date_created", "DESC"]]);
        $this->inbox = $result ? count($result) : "";
    }
}