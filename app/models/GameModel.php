<?php


class GameModel extends Model
{
    public function __construct($id = '')
    {
        $table = 'games';
        parent::__construct($table);
        $this->model = 'GameModel';

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

    public function getAll()
    {
        $result = $this->db->find($this->table, ['conditions' => ['deleted = ?'], 'bind' => [0], 'order' => ['name', 'ASC']]);

        $games = [];

        foreach ($result as $game){
            $model = new self();
            $model->populate($game);
            $games[] = $model;
        }
        return $games;
    }

}