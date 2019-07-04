<?php


class Validate
{
    private $passed = false;
    private $errors = [];
    private $db = null;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function validate($source, $items = [])
    {
        $this->errors = [];
        foreach ($items as $item => $rules) {
            $item = Input::sanitize($item);
            $display = $rules['display'];

            foreach ($rules as $rule => $rule_value) {
                $value = Input::sanitize(trim($source[$item]));
                if ($rule === 'required' && empty($value)) {
                    $this->addError(["{$display} is required", $item]);

                } else {
                    switch ($rule) {
                        case 'min':
                            if (strlen($value) < $rule_value) {
                                $this->addError(["{$display} must be a minimum of {$rule_value} characters.", $item]);
                            }
                            break;
                        case 'max':
                            if (strlen($value) > $rule_value) {
                                $this->addError(["{$display} must be a maximum of {$rule_value} characters.", $item]);
                            }
                            break;
                        case 'matches':
                            if ($value != $source[$rule_value]) {
                                $matchDisplay = $items[$rule_value]['display'];
                                $this->addError(["{$matchDisplay} and {$display} must match.", $item]);
                            }
                            break;
                        case 'unique':
                            $check = $this->db->query("SELECT {$item} FROM {$rule_value} WHERE {$item} = ?", [$value]);
                            if ($check->count()) {
                                $this->addError(["{$display} already exists. Please choose another ". strtolower($display), $item]);
                            }
                            break;
                        case 'unique_update':
                            $t = explode(',', $rule_value);
                            $table = $t[0];
                            $id = $t[1];
                            $query = $this->db->query("SELECT * FROM {$table} WHERE id != ? AND {$item} = ?", [$id, $value]);
                            if ($query->count()) {
                                $this->addError(["{$display} already exists. Please choose another {$display}.", $item]);
                            }
                            break;
                        case 'is_numeric':
                            if (!is_numeric($value)) {
                                $this->addError(["{$display} has to be a number. Please use a numeric value.", $item]);
                            }
                            break;
                        case 'valid_email':
                            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                                $this->addError(["{$display} must be a valid email address", $item]);
                            }
                            break;
                        case 'has_uppercase':
                            if (!preg_match('/[A-Z]/', $value)) {
                                $this->addError(["{$display} must have atleast 1 uppercase character.", $item]);
                            }
                            break;
                    }
                }
            }
        }
        if (empty($this->errors)){
            Session::delete('errors');
            $this->passed = true;
        }else{
            Session::set('errors', $this->errors());
        }
    }


    public function addError($error)
    {
        $this->errors[] = $error;
        if (empty($this->errors)) {
            $this->passed = true;
        } else {
            $this->passed = false;
        }
    }

    public function errors()
    {
        return $this->errors;
    }

    public function passed()
    {
        return $this->passed;
    }

    public function displayErrors()
    {
        $html = '<div class="card red lighten-1">
                 <div class="card-content">
                 <span class="card-title">Oh oh! Something went wrong.</span>
                 <ul>';
        foreach ($this->errors as $error) {
            if (is_array($error)) {
                $html .= '<li>' . $error[0] . '</li>';
            } else {
                $html .= '<li>' . $error . '</li>';
            }
        }

        $html .= "</ul>
                </div>
                </div>";

        return $html;
    }
}