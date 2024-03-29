<?php


class CountryModel extends Model
{
    public  $countries = [];

    public function __construct($id = '')
    {
        $table = 'countries';
        parent::__construct($table);
        $this->model = 'CountryModel';

        $data = [];
        if ($id != '') {
            if (is_int($id)) {
                $data = $this->db->findFirst($this->table, ['conditions' => 'id = ?', 'bind' => [$id]]);
            } else {
                $data = $this->db->findFirst($this->table, ['conditions' => 'country_code = ?', 'bind' => [$id]]);
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
        $result = $this->find();

        foreach ($result as $country) {
            $model = new CountryModel();
            $model->populate($country);
            $this->countries[] = $model;
        }
    }

}