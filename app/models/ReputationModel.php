<?php


class ReputationModel extends Model
{
    public $user;

    public function __construct($id = '')
    {
        $table = 'user_reputation';
        parent::__construct($table);
        $this->model = 'ReputationModel';
        $this->softDelete = true;
        $data = [];
        if ($id != '') {
            if (is_int($id)) {
                $data = $this->db->findFirst('user_reputation', ['conditions' => 'id = ?', 'bind' => [$id]]);
            }
            if ($data) {
                foreach ($data as $key => $value) {
                    $this->$key = $value;
                }
                $this->getUser();
            }

        }

    }

    public function getAll($user)
    {
        $result = $this->find(['conditions' => ['user_id = ?', 'deleted = ?'], 'bind' => [$user, 0], 'order' => ['date_created', 'DESC']]);
        return $result;
    }

    public function getUser()
    {
        $result = new UserModel((int)$this->given_by);
        $this->user = $result;
    }

    public function findByUserId($id)
    {
            return $this->findFirst(['conditions' => ['user_id = ?','given_by = ?', 'deleted = ?'], 'bind' => [$id[0],$id[1],0]]);
    }
}