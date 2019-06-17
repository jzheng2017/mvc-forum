<?php


class ThreadModel extends Model
{
    public $posts;
    public $user;

    public function __construct($thread = '')
    {
        $table = 'threads';
        parent::__construct($table);
        $this->model = 'ThreadModel';
        $data = [];
        if ($thread != '') {
            if (is_int($thread)) {
                $data = $this->db->findFirst('threads', ['conditions' => 'id = ?', 'bind' => [$thread]]);
            }
            if ($data) {
                foreach ($data as $key => $value) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function getAll($category)
    {
        $threads = $this->db->find($this->table, ["conditions" => ["category_id = ?", "deleted = 0"], "bind" => [$category], "order" => ['date_created', 'ASC']]);

        $list = [];
        if ($threads) {
            foreach ($threads as $thread) {
                $thread = (array)$thread;
                $model = new ThreadModel();
                $model->populate($thread);
                $list[] = $model;
            }
        }
        return $list;
    }

    public function getPosts()
    {
        $posts = $this->db->find('thread_posts', ['conditions' => ['thread_id = ?', 'deleted = 0'], 'bind' => [$this->id]]);
        $list = [];
        if ($posts) {
            foreach ($posts as $post) {
                $item = (array)$post;
                $model = new PostModel();
                $model->populate($item);
                $model->getUser();
                $list[] = $model;
            }
        }
        $this->posts = $list;
        return $list;
    }

    public function getUser()
    {
        $user = $this->db->query(Query::get('get_user_info'), [$this->created_by])->first();
        $model = new UserModel();
        $model->populate($user);
        $this->user = $model;
        return $this->user;
    }
}