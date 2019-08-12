<?php


class ThreadModel extends Model
{
    public $posts;
    public $user;
    public $important = false;

    public function __construct($thread = '')
    {
        $table = 'threads';
        parent::__construct($table);
        $this->model = 'ThreadModel';
        $this->softDelete = true;
        $data = [];
        if ($thread != '') {
            if (is_int($thread)) {
                $data = $this->db->findFirst($this->table, ['conditions' => 'id = ?', 'bind' => [$thread]]);
            }
            if ($data) {

                foreach ($data as $key => $value) {
                    $this->$key = $value;
                }
                $this->getUser();
            }
        }
    }

    public function getAll($category, $pagination = false, $offset = 0, $limit = 10)
    {
        if ($pagination) {
            $threads = new self();
            $threads = $threads->find(["conditions" => ["category_id = ?", "deleted = 0"], "bind" => [$category], "limit" => (string)($offset . "," . ($limit)), "order" => ["last_updated DESC, date_created DESC"]]);
        } else {
            $threads = $this->db->query(Query::get('get_threads'), [$category])->result();
        }

        $list = [];
        if ($threads) {
            foreach ($threads as $thread) {
                $model = new self();
                $model->populate($thread);
                $model->posts = $model->getPosts();
                $model->user = $model->getUser();
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
                $model = new PostModel();
                $model->populate($post);
                $model->getUser();
                $list[] = $model;
            }
        }
        $this->posts = $list;
        return $list;
    }

    public function getUser()
    {
        $model = new UserModel();
        $model->getUserInfo($this->created_by);
        $this->user = $model;
        return $this->user;
    }

    public function generateUrl()
    {
        return 'thread/view/' . $this->db->lastId();
    }
}