<?php


class UserModel extends Model
{
    private $isLoggedIn;
    private $session;
    private $cookie;
    public static $currentUser = null;


    public function __construct($user = '')
    {
        $table = 'users';
        parent::__construct($table);
        $this->model = 'UserModel';
        $this->session = CURRENT_USER_SESSION_NAME;
        $this->cookie = REMEMBER_ME_COOKIE;

        $this->softDelete = true;

        if ($user != '') {
            if (is_int($user)) {
                $data = $this->db->findFirst($this->table, ['conditions' => 'id = ?', 'bind' => [$user]]);
            } else {
                $data = $this->db->findFirst($this->table, ['conditions' => 'username = ?', 'bind' => [$user]]);
            }
            if ($data) {
                foreach ($data as $key => $value) {
                    $this->$key = $value;
                }
            }

        }
    }

    public function findByUsername($username = '')
    {
        return $this->findFirst(['conditions' => 'username = ?', 'bind' => [$username]]);
    }

    public static function currentLoggedInUser()
    {
        if (!isset(self::$currentUser) && Session::exists(CURRENT_USER_SESSION_NAME)) {
            $user = new UserModel();
            $user->getUserInfo((int)Session::get(CURRENT_USER_SESSION_NAME));
            self::$currentUser = $user;
        }
        return self::$currentUser;
    }

    public function login($rememberMe = false)
    {
        Session::set($this->session, $this->id);
        if ($rememberMe) {
            $hash = md5((string)((int)uniqid() + rand(0, 100)));
            $user_agent = Session::useragent_no_version();
            Cookie::set($this->cookie, $hash, REMEMBER_ME_COOKIE_EXPIRY);
            $fields = ['session' => $hash, 'user_agent' => $user_agent, 'user_id' => $this->id];
            $this->db->query(Query::get('delete_user_session'), [$this->id, $user_agent]);
            $this->db->insert('user_sessions', $fields);
        }
    }

    public function logout()
    {
        $user_agent = Session::useragent_no_version();
        if (!$this->db->query(Query::get('delete_user_session'), [$this->id, $user_agent])->error()) {

            Session::delete(CURRENT_USER_SESSION_NAME);
            if (Cookie::exists(REMEMBER_ME_COOKIE)) {
                Cookie::delete(REMEMBER_ME_COOKIE);
            }
            self::$currentUser = null;

            return true;
        } else {
            return false; // not logged out
        }
    }

    public static function loginUserFromCookie()
    {
        $userSession = UserSessionModel::getFromCookie();
        if ($userSession) {
            if ($userSession->user_id != '') {
                $user = new self();
                $user->getUserInfo((int)$userSession->user_id);
            }
            if ($user) {
                $user->login();
            }
            return $user;
        }
    }

    public function registration($result)
    {
        unset($result['confirm_email']);
        unset($result['confirm_password']);
        $result['password'] = password_hash($result['password'], PASSWORD_DEFAULT);
        $this->populate($result);
        if ($this->save()) {
            UserPointsModel::create($this->db->lastId());
        }
    }

    public function getUserInfo($id)
    {
        $user = $this->db->query(Query::get('get_user_info'), [$id])->first();
        $this->populate($user);
    }

    public function getStatus()
    {
        $status = $this->db->query(Query::get('user_status'), [$this->id])->result();
        if ($status) {
            return true;
        } else {
            return false;
        }
    }

    public function getAll($additional = false)
    {
        $users = $this->db->query(Query::get('get_users'))->result();
        $models = [];
        foreach ($users as $user) {
            $model = new self();
            $model->populate($user);
            if ($additional) $model->getUserInfo($model->id); //get aditional data
            $models[] = $model;
        }
        return $models;
    }


    public function getCountry()
    {
        $country = new CountryModel($this->country);
        $this->country = $country;
        return $country;
    }

    public function getUsersByRank($rank)
    {
        $users = $this->db->query(Query::get('get_users_by_rank'), [$rank])->result();

        $models = [];
        if ($users) {
            foreach ($users as $user) {
                $model = new UserModel();
                $model->populate($user);
                $models[] = $model;
            }
        }
        return $models;
    }

    public function getPoints()
    {
        $model = new UserPointsModel((int)$this->id);
        $this->points = $model;
        return $model;
    }
}