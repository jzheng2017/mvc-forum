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
                $data = $this->db->findFirst($this->table, ['conditions' => 'id = ?', 'bind' => [$post]]);
            }
            if ($data) {
                foreach ($data as $key => $value) {
                    $this->$key = $value;
                }
                $this->getUser();
                $this->getParent();
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

    public function getParent(){
        $model = new ThreadModel((int)$this->thread_id);
        $this->parent = $model;
        return $model;
    }

    public function getAllByUser($id){
        $posts = $this->db->query(Query::get('get_user_posts'), [$id])->result();
        $models = [];
        if ($posts){
            foreach ($posts as $post){
                $model = new PostModel();
                $model->populate($post);
                $models[] = $model;
            }
        }

        return $models;
    }
}