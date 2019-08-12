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

    public function usersAction($page = 1){
        Log::logAction('Statistics', 'Users', $page);
        $db = Database::getInstance();

        $limit = 10; //items per page
        $user = new UserModel();
        $count = count($db->query(Query::get('get_users'))->result());

        $maxPage = ceil($count / $limit);

        if ($page < 1){
            Router::redirect('stats/users/1');
        } else if ($page > $maxPage){
            Router::redirect('stats/users/'.$maxPage);
        }

        $offset = $page == 1 ? 0 : ($page - 1) * $limit;
        $users = $user->getAll(false, true, $offset, $limit);

        $this->view->users = $users;
        $this->view->currentPage = $page;
        $this->view->maxPage = $maxPage;

        $this->view->render('stats/user_list');
    }
}