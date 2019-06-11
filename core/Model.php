<?php


class Model
{
    protected $db;
    protected $table;
    protected $model;
    protected $softDelete = false;
    protected $columnNames = [];

    public $id;

    public function __construct($table)
    {
        $this->db = Database::getInstance();
        $this->table = $table;
        $this->setTableColumns();
        $this->model = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->table)));
    }

    protected function setTableColumns()
    {
        $columns = $this->get_columns();

        foreach ($columns as $column) {
            $this->columnNames[] = $column->Field;
            $this->{$column->Field} = null;
        }
    }

    public function get_columns()
    {
        return $this->db->get_columns($this->table);
    }

    protected function populate($result)
    {
        foreach ($result as $key => $value) {
            $this->$key = $value;
        }
    }

    public function find($params = [])
    {
        $results = [];
        $resultsQuery = $this->db->find($this->table, $params);
        foreach ($resultsQuery as $result) {
            $obj = new $this->model($this->table);
            $obj->populate($result);
            $results[] = $obj;
        }
        return $results;
    }

    public function findFirst($params = [])
    {
        $resultQuery = $this->db->findFirst($this->table, $params);
        $result = new $this->model($this->table);
        if ($resultQuery) {
            $result->populate($resultQuery);
        }

        return $result;
    }

    public function findById($id)
    {
        return $this->findFirst(['condition' => 'id = ?', 'bind' => [$id]]);
    }

    public function save()
    {
        $fields = [];

        foreach ($this->columnNames as $column) {
            $fields[$column] = $this->column;
        }

        //cdetermine whether to update or insert
        if (property_exists($this, 'id') && $this->id != '') {
            return $this->update($this->id, $fields);
        } else {
            return $this->insert($fields);
        }
    }

    public function insert($fields)
    {
        if (empty($fields)) {
            return false;
        }
        return $this->db->insert($this->table, $this->fields);
    }

    public function update($id, $fields)
    {
        if (empty($fields) || empty($id)) {
            return $this->db->update($this->table, $id, $fields);
        }
    }

    public function delete($id)
    {
        if (empty($id) && empty($this->id)) {
            return false;
        }
        $id = ($id == '') ? $this->id : $id;
        if ($this->softDelete) {
            return $this->update($id, ['deleted' => 1]);
        }

        return $this->db->delete($this->table, $id);

    }

    public function query($sql, $bind = [])
    {
        return $this->db->query($sql, $bind);
    }

    public function data()
    {
        $data = new stdClass();

        foreach ($this->columnNames as $column) {
            $data->column = $this->column;
        }
        return $data;
    }

    public function assign($params)
    {
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                if (in_array($key, $this->columnNames)) {
                    $this->key = sanitize($value);
                }
            }
            return true;
        }
        return false;
    }


}



