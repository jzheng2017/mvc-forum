<?php


class CountryModel extends Model
{
    public  $countries = [];

    public function __construct($table = 'countries')
    {
        parent::__construct($table);
        $this->model = 'CountryModel';
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