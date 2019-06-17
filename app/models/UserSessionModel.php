<?php


class UserSessionModel extends Model
{

    public function __construct()
    {
        $table = 'user_sessions';
        parent::__construct($table);
        $this->model = 'UserSessionModel';
    }

    public static function getFromCookie()
    {
        if (Cookie::exists(REMEMBER_ME_COOKIE)) {
            $userSession = new self();
            $userSession = $userSession->findFirst(['conditions' => ['user_agent = ? AND session = ?'], 'bind' => [Session::useragent_no_version(), Cookie::get(REMEMBER_ME_COOKIE)]]);
            if (!$userSession) {
                return false;
            } else {
                return $userSession;
            }
        }
    }
}