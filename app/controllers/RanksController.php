<?php


class RanksController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    public function indexAction()
    {
        Log::logAction('Ranks', 'Index', -1);

        $this->view = new RanksView();

        $db = Database::getInstance();

        $result = $db->query(Query::get('get_user_by_points'))->result();
        $this->view->users = $result;

        $this->view->render('ranks/index');
    }

    public function listAction($id = '')
    {
        Log::logAction('Ranks', 'List', -1);

        $this->view = new RanksView();
        if ($id == '') {
            $model = new RanksModel();
            $this->view->ranks = $model->getAll();

            if ($_POST) {
                if (Input::get('rank') > UserModel::currentLoggedInUser()->rank) {
                    $m = new RanksModel((int)Input::get('rank'));
                    if (UserModel::currentLoggedInUser()->getPoints() >= $m->requirement) {
                        UserModel::currentLoggedInUser()->rank = $m->rank;
                        UserModel::currentLoggedInUser()->save();
                        $log = new UserRanksLogModel();
                        $log->rank_id = $m->rank;
                        $log->user_id = UserModel::currentLoggedInUser()->id;
                        $log->points = UserModel::currentLoggedInUser()->points->points;
                        $log->save();
                    }
                }
            }
            $this->view->render('ranks/list');
        } else {
            $model = new RanksModel((int)$id);
            if ($model->exists()) {
                $this->view->rank = $model;
                $model = new UserModel();
                $this->view->users = $model->getUsersByRank($id);
                $this->view->render('ranks/list_by_rank');
            } else {
                Router::redirect('error');
            }
        }


    }
}