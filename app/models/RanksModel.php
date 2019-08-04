<?php


class RanksModel extends Model
{
    public function __construct($id = '')
    {
        $table = 'user_ranks';
        parent::__construct($table);
        $this->model = 'RanksModel';
        $this->softDelete = false;
        $data = [];
        if ($id != '') {
            if (is_int($id)) {
                $data = $this->db->findFirst($this->table, ['conditions' => 'rank = ?', 'bind' => [$id]]);
            }
            if ($data) {
                foreach ($data as $key => $value) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function getAll(){
        $ranks = $this->db->query(Query::get('get_ranks'))->result();

        $models = [];
        if ($ranks){
            foreach ($ranks as $rank){
                $model = new RanksModel();
                $model->populate($rank);
                $models[] = $model;
            }
        }
        return $models;
    }

    public function achieved(){
        $result = $this->db->query(Query::get('amount_of_users_by_rank'), [$this->rank])->result();
        return $result;
    }

    public function exists(){
        return $this->rank != NULL ? true : false;
    }


}