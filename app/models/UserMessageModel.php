<?php


class UserMessageModel extends Model
{
    public $senderModel;

    public function __construct($message = '')
    {
        $table = 'user_messages';
        parent::__construct($table);

        $this->model = 'UserMessageModel';
        $this->softDelete = true;

        $data = [];
        if ($message != '') {
            if (is_int($message)) {
                $data = $this->db->findFirst('user_messages', ['conditions' => 'id = ?', 'bind' => [$message]]);
            }
            if ($data) {
                foreach ($data as $key => $value) {
                    $this->$key = $value;
                }

                $this->senderModel = new UserModel((int)$this->sender);
            }

        }
    }
}