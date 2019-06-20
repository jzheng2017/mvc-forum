<?php


class ActionModel extends Model
{
    public $user;

    public function __construct($id = '')
    {
        $table = 'user_actions';
        parent::__construct($table);
        $this->model = 'ActionModel';

        $data = [];
        if ($id != '') {
            if (is_int($id)) {
                $data = $this->db->findFirst('categories', ['conditions' => 'id = ?', 'bind' => [$id]]);
            }
            if ($data) {
                foreach ($data as $key => $value) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function exists()
    {
        $result = $this->findFirst(["conditions" => ["type = ?", "action = ?", "object_id = ?"], "bind" => [$this->params[0], $this->params[1], $this->params[2]]]);
        if ($result->id) {
            $this->resultModel = $result;
            $this->resultModel->user = new UserModel();
            $this->resultModel->user->getUserInfo($result->user_id);
            return true;
        } else {
            return false;
        }
    }

    public function deleteObject(){
        if ($this->params[0] == 'thread'){
            $model = new ThreadModel();
            $model->delete($this->params[2]);
        }else if ($this->params[0] == 'post'){
            $model = new PostModel();
            $model->delete($this->params[2]);
        }
    }
}