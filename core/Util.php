<?php


class Util
{
    private function __construct()
    {
        //can not be instantiated
    }

    //generate link to the object passed in from the parameters
    public static function userCurrentPage($controller, $action, $object_id)
    {
        if ($controller == 'Statistics') {
            if ($action == 'Online') {
                return "<a href=''>Statistics users online</a>";
            } else if ($action == 'Posts') {
                return '<a href="' . PROOT . 'stats/posts">Statistics posts today</a>';
            }
        } else if ($controller == 'Thread') {
            if ($action == 'View') {
                $model = new ThreadModel((int)$object_id);
                return '<a href="' . PROOT . 'thread/view/' . $model->id . '">Thread |  ' . $model->title . '</a>';
            } else if ($action == 'Create') {
                return '<a href="' . PROOT . 'thread/create">Creating a new thread</a>';
            }
        } else if ($controller == 'Category') {
            if ($action == 'View') {
                $model = new CategoryModel((int)$object_id);
                return '<a href="' . PROOT . 'category/view/' . $model->id . '">Category | ' . $model->name . '</a>';
            }
        } else if ($controller == 'Index') {
            return '<a href="' . PROOT . '">Homepage</a>';
        } else if ($controller == 'User') {
            if ($action == 'Profile') {
                if ($object_id > -1) {
                    $model = new UserModel((int)$object_id);
                    return '<a href="' . PROOT . 'user/profile/' . $model->id . '">Profile | ' . $model->username . '</a>';
                } else {
                    return '<a href="' . PROOT . 'user/profile">Users own profile</a>';
                }
            } else if ($action == 'Inbox') {
                return '<a href="' . PROOT . 'user/inbox">Inbox</a>';
            } else if ($action == 'Reputation') {
                $model = new ReputationModel((int)$object_id);
                return '<a href="' . PROOT . 'user/reputation/' . $model->id . '">' . $model->user->username . '\'s reputation</a>';
            } else if ($action == 'Rate') {
                return 'Rating a user';
            }
        } else if ($controller == 'Search') {
            if ($action == 'Index') {
                return 'Searching';
            }
        } else if ($controller == 'Games') {
            if ($action == 'Index') {
                return '<a href="' . PROOT . 'games">' . 'Game list</a>';
            }
        } else if ($controller == 'Error' || $controller == 'Restricted') {
            return 'Error page';
        }
    }

    //get last action from an object, for instance get last action from thread (last post)
    public static function lastAction($type, $id = '')
    {
        $db = Database::getInstance();
        if ($type == 'thread') {
            if ($id != '') {
                $result = $db->findFirst('thread', ['conditions' => ['user_id = ?', 'id = ?'], 'bind' => [UserModel::currentLoggedInUser()->id, $id], 'order' => ['date_created', 'DESC']]);
            } else {
                $result = $db->findFirst('thread', ['conditions' => ['user_id = ?'], 'bind' => [UserModel::currentLoggedInUser()->id], 'order' => ['date_created', 'DESC']]);
            }
            return $result;
        } else if ($type == 'thread_post') {
            if ($id != '') {
                $result = $db->findFirst('thread_posts', ['conditions' => ['user_id = ?', 'id = ?'], 'bind' => [UserModel::currentLoggedInUser()->id, $id], 'order' => ['date_created', 'DESC']]);
            } else {
                $result = $db->findFirst('thread_posts', ['conditions' => ['user_id = ?'], 'bind' => [UserModel::currentLoggedInUser()->id], 'order' => ['date_created', 'DESC']]);
            }
            return $result;
        } else if ($type == 'user_message') {
            if ($id != '') {
                $result = $db->findFirst('user_messages', ['conditions' => ['sender = ?', 'id = ?'], 'bind' => [UserModel::currentLoggedInUser()->id, $id], 'order' => ['date_created', 'DESC']]);
            } else {
                $result = $db->findFirst('user_messages', ['conditions' => ['sender = ?'], 'bind' => [UserModel::currentLoggedInUser()->id], 'order' => ['date_created', 'DESC']]);
            }
            return $result;
        } else if ($type == 'action') {
            if ($id != '') {
                $result = $db->findFirst('user_actions', ['conditions' => ['user_id = ?'], 'bind' => [$id], 'order' => ['date_created', 'DESC']]);
            } else {
                $result = $db->findFirst('user_actions', ['conditions' => ['user_id = ?'], 'bind' => [UserModel::currentLoggedInUser()->id], 'order' => ['date_created', 'DESC']]);
            }
            return $result;
        }
    }

    //Checks in the database whether the input exists, for instance an username
    public static function exists($type, $input)
    {
        $db = Database::getInstance();

        if ($type == 'email') {
            return $db->findFirst('users', ['conditions' => ['email = ?'], 'bind' => [$input]]);
        } else if ($type == 'username') {
            return $db->findFirst('users', ['conditions' => ['username = ?'], 'bind' => [$input]]);
        } else if ($type == 'reputation') {
            return $db->findFirst('user_reputation', ['conditions' => ['user_id = ?'], 'bind' => [$input]]);
        }
    }

    //recover user by looking for username or email
    public static function getByUsernameEmail($user)
    {
        $email = self::exists('email', $user);
        $username = self::exists('username', $user);
        if ($email) {
            return $email;
        } else if ($username) {
            return $username;
        }
    }

    //generate random code
    public static function generateCode()
    {
        return base64_encode(md5(rand()));
    }

    //searches a list of threads if it contains an important thread
    public static function hasImportantThreads($threads)
    {
        $important = false;
        if ($threads) {
            foreach ($threads as $thread) {
                if ($thread->important) {
                    $important = true;
                }
            }
        } else {
            return false;
        }
        return $important;
    }

    public static function generateReputationView(array $reputations)
    {
        $values = [
            "positive" => 0,
            "neutral" => 0,
            "negative" => 0
        ];

        foreach ($reputations as $reputation) {
            if ($reputation->rating > 0) {
                $values['positive']++;
            } else if ($reputation->rating == 0) {
                $values['neutral']++;
            } else if ($reputation->rating < 0) {
                $values['negative']++;
            }
        }

        $rep = $values['positive'] - $values['negative'];
        $color = $rep > 0 ? "green-text" : "red-text";
        $color = $rep == 0 ? "" : $color;
        $total = count($reputations);

        return "<div class='card col s12 grey lighten-3'>
                   <div class='card-content'>
                      <ul>
                      <li>
                        Reputation: <span class='$color'>$rep</span>
                        </li>
                        <div class='divider grey'></div>
                        <li>
                         Positive: $values[positive]            
                         </li>
                         <li>
                         Neutral: $values[neutral]
                        </li>
                        <li>
                        Negative: $values[negative]
                        </li>
                        <div class='divider grey'></div>
                        <li>
                        Total: $total
                        </li>
                      </ul>
                    </div>
                </div>";
    }


    public static function highlight($text, $words)
    {
        preg_match_all('~\w+~', $words, $m);
        if (!$m)
            return $text;
        $re = '~(' . implode('|', $m[0]) . ')~i';
        return preg_replace($re, '<span class="yellow">$0</span>', $text);
    }

    public static function message($message, $class = '')
    {
        return "<div class='card $class'>
                    <div class='card-content'>
                    <p>
                    $message
                    </p>
                    </div>
                </div>";
    }

}