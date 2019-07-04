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
                return '<a href="' . PROOT . 'category/create">Creating a new thread in </a>';
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
    public static function generateCode(){
        return base64_encode(md5(rand()));
    }
}