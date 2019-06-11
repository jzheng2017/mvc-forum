<?php


class Database
{
    private static $instance = null;
    private $pdo;
    private $query;
    private $error = false;
    private $result = [];
    private $count = 0;
    private $lastInsertID = null;

    private function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function query($sql, $params = [])
    {
        $this->error = false;
        if ($this->query = $this->pdo->prepare($sql)) {
            $x = 1;
            if (count($params)) {
                foreach ($params as $param) {
                    $this->query->bindValue($x, $param);
                    $x++;
                }
            }
        }
        if ($this->query->execute()) {

            $this->result = $this->query->fetchAll(PDO::FETCH_OBJ);
            $this->count = $this->query->rowCount();
            $this->lastInsertID = $this->pdo->lastInsertId();
        } else {
            $this->error = true;
        }

        return $this;
    }

    public function insert($table, $fields = [])
    {
        $sql = "";
        if (count($fields)) {
            $keys = array_keys($fields);
            $sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES (" . str_repeat("?, ", count($keys) - 1) . "?)";
        }

        if (!$this->query($sql, array_values($fields))->error()) {
            return true;
        } else {
            return false;
        }
    }


    public function update($table, $id, $fields = [])
    {
        $sql = "";
        if (count($fields)) {
            $keys = implode(' = ?, ', array_keys($fields)) . ' = ?';

            $sql = "UPDATE {$table} SET {$keys} WHERE id = {$id}";
        }


        if (!$this->query($sql, array_values($fields))->error()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($table, $id)
    {
        $sql = "DELETE FROM {$table} WHERE id = '{$id}'";

        if (!$this->query($sql)->error()) {
            return true;
        } else {
            return false;
        }
    }

    public function first()
    {
        return (!empty($this->result)) ? $this->result[0] : [];
    }

    public function count()
    {
        return $this->count;
    }

    public function lastId()
    {
        return $this->lastInsertID;
    }

    public function get_columns($table)
    {
        return $this->query("SHOW COLUMNS FROM {$table}")->result();
    }

    protected function read($table, $params = [])
    {
        $conditionString = '';
        $bind = [];
        $order = '';
        $limit = '';
        //conditions
        if (isset($params['conditions'])) {
            if (is_array($params['conditions'])) {
                foreach ($params['conditions'] as $condition) {
                    $conditionString .= ' ' . $condition . ' AND';
                }


                $conditionString = trim($conditionString);
                $conditionString = rtrim($conditionString, 'AND');

            } else {
                $conditionString = $params['conditions'];
            }
        }

        if ($conditionString != '') {
            $conditionString = 'WHERE ' . $conditionString;
        }

        //bind
        if (array_key_exists('bind', $params)) {
            $bind = $params['bind'];
        }

        //order
        if (array_key_exists('order', $params)) {
            $order = 'ORDER BY ' . $params['order'];
        }

        //limit
        if (array_key_exists('limit', $params)) {
            $limit = 'LIMIT ' . $params['limit'];
        }

        $sql = "SELECT * FROM {$table} {$conditionString} {$order} {$limit}";

        if ($this->query($sql, $bind)) {
            if (!count($this->result)) {

                return false;
            }

            return true;
        }

        return false;


    }

    public function find($table, $params = [])
    {
        if ($this->read($table, $params)) {
            return $this->result();
        }

        return false;
    }

    public function findFirst($table, $params = [])
    {

        if ($this->read($table, $params)) {

            return $this->first();
        }
        return false;
    }

    public function error()
    {
        return $this->error;
    }

    public function result()
    {
        return $this->result;
    }
}