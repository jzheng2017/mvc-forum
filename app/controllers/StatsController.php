<?php


class StatsController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    public function indexAction(){
        Log::logAction('Statistics', 'Index', '-1');
        Router::redirect('');
    }

    public function onlineAction(){
        Log::logAction('Statistics', 'Online', '-1');
        $db = Database::getInstance();
        $this->view->users = $db->query(Query::get('users_activity'))->result();
        $this->view->render('stats/users_online');
    }

    public function postsAction(){
        Log::logAction('Statistics', 'Posts', '-1');
        $db = Database::getInstance();
        $this->view->posts = $db->query(Query::get('post_stats'))->result();
        $this->view->render('stats/posts');
    }

    public function usersAction(){
        Log::logAction('Statistics', 'Users', -1);
        $db = Database::getInstance();
        $user = new UserModel();
        $this->view->users = $user->getAll();
        $this->view->render('stats/user_list');
    }
}