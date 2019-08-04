<?php


class UserPointsModel extends Model
{
    public function __construct($id = '')
    {
        $table = 'user_points';
        parent::__construct($table);
        $this->model = 'UserPointsModel';

        $data = [];
        if ($id != '') {
            if (is_int($id)) {
                $data = $this->db->findFirst($this->table, ['conditions' => 'user_id = ?', 'bind' => [$id]]);
            }
            if ($data) {
                foreach ($data as $key => $value) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function getLog(){
        $logs = $this->db->find($this->table,['conditions' => ['user_id = ?'], 'bind' => [$this->user_id], 'order' => ['date_created', 'DESC']]);

        $models = [];
        if ($logs){
            foreach($logs as $log){
                $model = new UserPointsLogModel();
                $model->populate($log);
                $models[] = $model;
            }
        }
        return $models;
    }

    public static function create($id){
        $model = new self();
        $model->points = 0;
        $model->user_id = $id;
        return $model->save();
    }
}