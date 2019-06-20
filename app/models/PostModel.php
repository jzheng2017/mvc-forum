<?php


class PostModel extends Model
{
    public $user;

    public function __construct($post = '')
    {
        $table = 'thread_posts';
        parent::__construct($table);
        $this->model = 'PostModel';
        $this->softDelete = true;
        $data = [];
        if ($post != '') {
            if (is_int($post)) {
                $data = $this->db->findFirst('thread_posts', ['conditions' => 'id = ?', 'bind' => [$post]]);
            }
            if ($data) {
                foreach ($data as $key => $value) {
                    $this->$key = $value;
                }
                $this->getUser();
            }
        }
    }

    public function getUser()
    {
        $model = new UserModel();
        $model->getUserInfo($this->user_id);
        $this->user = $model;
        return $this->user;
    }

}