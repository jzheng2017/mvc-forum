<?php


class SearchController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    public function indexAction()
    {
        Log::logAction("Search", "Index", -1);
        if ($_GET) {
            $validation = new Validate();
            $validation->validate($_GET, [
                "query" => [
                    "display" => "Query",
                    "min" => 3,
                    "required" => true,
                ],
                "type" => [
                    'display' => 'Type',
                    "required" => true
                ]
            ]);
            if ($validation->passed()) {
                $db = Database::getInstance();
                if (Input::get('type') == 'user') {
                    $this->view->result = $db->query(Query::get('search_user'), ["%" . Input::get('query') . "%"])->result();
                    $this->view->type = 'user';
                } else if (Input::get('type') == 'thread') {
                    $this->view->result = $db->query(Query::get('search_thread'), ["%" . Input::get('query') . "%", "%" . Input::get('query') . "%"])->result();
                    $this->view->type = 'thread';
                } else if (Input::get('type') == 'post') {
                    $this->view->result = $db->query(Query::get('search_posts'), ["%" . Input::get('query') . "%"])->result();
                    $this->view->type = 'post';
                }
                $this->view->render('search/result');
            } else {
                $this->view->errors = $validation->displayErrors();
                $this->view->render('search/search');
            }
        }
        if (empty($_GET)) {
            $this->view->render('search/search');
        }
    }


}