<?php


class StatsComponent extends Component
{
    public $user;
    public $post;
    public function __construct($component)
    {
        $this->data();
        parent::__construct($component);

    }

    private function data(){
        $db = Database::getInstance();
        $this->user = $db->query(Query::get('users_online'))->result();
        $this->post = count($db->query(Query::get('post_stats'))->result());
    }
}