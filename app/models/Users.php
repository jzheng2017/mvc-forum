<?php


class Users extends Model
{
    private $isLoggedIn;
    private $session;
    private $cookie;
    public static $currentUser = null;

    public function __construct($user = '')
    {
        $table = 'users';
        parent::__construct($table);
        $this->session = CURRENT_USER_SESSION_NAME;
        $this->cookie = REMEMBER_ME_COOKIE;
        $this->softDelete = true;

        if ($user != '') {
            if (is_int($user)) {
                $data = $this->db->findFirst('users', ['conditions' => 'id = ?', 'bind' => [$user]]);
            } else {
                $data= $this->db->findFirst('users', ['conditions' => 'username = ?', 'bind' => [$user]]);
            }
            if ($data){
                foreach ($data as $key => $value){
                    $this->$key = $value;
                }
            }

        }
    }

    public function findByUsername($username = ''){
        return $this->findFirst(['conditions' => 'username = ?', 'bind' => [$username]]);
    }

    public function login($rememberMe = false){
        Session::set($this->session, $this->id);
        if ($rememberMe){
            $hash = md5(uniqid() + rand(0,100));
            $user_agent = Session::useragent_no_version();
            Cookie::set($this->cookie, $hash, REMEMBER_COOKIE_EXPIRY);
            $fields = ['session' => $hash, 'user_agent' => $user_agent, 'user_id' => $this->id];
            $this->db->query("DELETE FROM user_sessions WHERE user_id ? AND user_agent = ?", [$this->id, $user_agent]);
            $this->db->insert('user_sessions', $fields);
        }
    }
}