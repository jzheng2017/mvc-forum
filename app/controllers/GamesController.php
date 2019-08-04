<?php


class GamesController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    public function indexAction()
    {
        Log::logAction('Games', 'Index', -1);

        $games = new GameModel();
        $games = $games->getAll();

        $this->view->games = $games;

        $this->view->render('games/index');
    }

//    public function viewAction($id = -1){
//        Log::logAction('Games', 'Index', $id);
//
//        $game = new GameModel((int)$id);
//
//        $game->exists() ? Router::redirect('games/'.$game->link) : Router::redirect('error');
//    }

    public function guessthenumberAction()
    {
        $this->view = new GameView();
        $game = new GameModel(str_replace("Action", "", $this->action));
        $game->exists() ? "" : Router::redirect('error');
        Log::logAction('Games', 'Guess The Number', $game->id);
        $this->view->game = $game;

        if ($_POST) {
            $validation = new Validate();
            $validation->validate($_POST, [
                'max' => [
                    'display' => 'Max'
                ],
                'min' => [
                    'display' => 'Min',
                    'required' => true,
                    'is_numeric' => true,
                    'not_greater' => 'max'
                ],
                'input' => [
                    'display' => 'Input number',
                    'required' => true,
                    'is_numeric' => true,
                    'not_greater' => 'max']
            ]);
            if ($validation->passed()) {

            } else {
                $this->view->errors = $validation->displayErrors();
            }
        }
        $this->view->render('games/' . $game->template);
    }
}