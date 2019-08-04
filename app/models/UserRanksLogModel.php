<?php


class UserRanksLogModel extends Model
{
    public function __construct($id = '')
    {
        $table = 'user_ranks_log';
        parent::__construct($table);
        $this->model = 'UserRanksLogModel';
        $data = [];
        if ($id != '') {
            if (is_int($id)) {
                $data = $this->db->findFirst($this->table, ['conditions' => 'id = ?', 'bind' => [$id]]);
            }
            if ($data) {
                foreach ($data as $key => $value) {
                    $this->$key = $value;
                }
            }
        }
    }

}