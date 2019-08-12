<?php


class UserPointsLogModel extends Model
{
    public function __construct($id = '')
    {
        $table = 'user_points_log';
        parent::__construct($table);
        $this->model = 'UserPointsLogModel';

        $data = [];
        if ($id != '') {
            if (is_int($id)) {
                $data = $this->db->findFirst($this->table, ['conditions' => 'points_id = ?', 'bind' => [$id]]);
            }
            if ($data) {
                foreach ($data as $key => $value) {
                    $this->$key = $value;
                }
            }
        }
    }
}