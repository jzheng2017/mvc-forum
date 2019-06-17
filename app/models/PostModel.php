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
            }
        }
    }

    public function getUser()
    {
        $user = $this->db->query(Query::get('get_user_info'), [$this->user_id])->first();
        $model = new UserModel();
        $model->populate($user);
        $this->user = $model;
        return $this->user;
    }

}