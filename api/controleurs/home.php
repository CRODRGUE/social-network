<?php

require_once(__DIR__ . '/../bdd_con.php');
require_once(__DIR__ . '/../modeles/user.php');
require_once(__DIR__ . '/../modeles/post.php');


class Home
{
    public function exec(array $data)
    {
        session_start();
        if (isset($_SESSION['id_user']) && isset($_SESSION['status']) && isset($_SESSION['status']) === true && $_SESSION['id_user'] != '') {
            $Post = new PostRepository();
            $Post->con = new BDD();
            $User = new UserRepository();
            $User->con = new BDD();
            (!isset($data['page']) || empty($data['page']) ? $page = 0 : $page = intval($data['page']));
            $resUser = $User->getUserById($_SESSION['id_user']);
            $resPost = $Post->getUserFreindPost($_SESSION['id_user'], $page);
            if ($resPost !== false && $resUser !== false) {
                require_once(__DIR__ . '/../../templates/home.php');
            } else {
                $mes = 'Oupss une erreur c\'est produite...';
                header("Location: http://localhost/modulePHP/projet_php/index?action=err&mes=" . $mes);
                exit();
            }
        } else {
            header("Location: http://localhost/modulePHP/projet_php/index?action=connexion");
            exit();
        }
    }
}
