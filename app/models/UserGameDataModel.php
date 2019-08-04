<?php


class UserGameDataModel extends Model
{
    public function __construct($id = '')
    {
        $table = 'user_game_data';
        parent::__construct($table);
        $this->model = 'UserGameDataModel';

        $data = [];
        if ($id != '') {
            if (is_int($id)) {
                $data = $this->db->findFirst($this->table, ['conditions' => 'id = ?', 'bind' => [$id]]);
            } else {
                $data = $this->db->findFirst($this->table, ['conditions' => 'link = ?', 'bind' => [$id]]);
            }
            if ($data) {
                foreach ($data as $key => $value) {
                    $this->$key = $value;
                }
            }
        }
    }


}