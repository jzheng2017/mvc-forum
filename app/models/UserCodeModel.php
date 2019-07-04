<?php


class UserCodeModel extends Model
{

    public $user;

    public function __construct($id = '')
    {
        $table = 'user_codes';
        parent::__construct($table);
        $this->model = 'UserCodeModel';
        $this->softDelete = false;

        $data = [];
        if ($id != '') {
            if (is_int($id)) {
                $data = $this->db->findFirst('user_codes', ['conditions' => 'id = ?', 'bind' => [$id]]);
            }
            if ($data) {
                foreach ($data as $key => $value) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function findByCode($code)
    {
        return $this->findFirst(['conditions' => ['code = ?'], 'bind' => [$code]]);
    }

    public function getUser()
    {
        $model = new UserModel((int)$this->user_id);
        $this->user = $model;
        return $this->user;
    }
}