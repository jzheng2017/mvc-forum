<?php


class CategoryModel extends Model
{
    public $subcategories = [];

    public function __construct($category = '')
    {
        $table = 'categories';
        parent::__construct($table);
        $this->model = 'CategoryModel';
        $data = [];
        if ($category != '') {
            if (is_int($category)) {
                $data = $this->db->findFirst('categories', ['conditions' => 'id = ?', 'bind' => [$category]]);
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
        $categories = $this->find(["conditions" => ["parent_id IS NULL"],"order" => ['show_order', 'DESC']]);

        $list = [];
        foreach ($categories as $category) {
            $model = new CategoryModel();
            $model->populate($category);
            $list[] = $model;
        }
        return $list;
    }

    public function getChildren()
    {
        $subcategories = $this->find(["conditions" => ["parent_id = ?"], "bind" => [$this->id]]);

        foreach ($subcategories as $category) {
            $model = new CategoryModel();
            $model->populate($category);
            $this->subcategories[] = $model;
        }

        return $this->subcategories;
    }
}