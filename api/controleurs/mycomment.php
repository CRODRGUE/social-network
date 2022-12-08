<?php
require_once(__DIR__ . '/../bdd_con.php');
require_once(__DIR__ . '/../modeles/user.php');
require_once(__DIR__ . '/../modeles/comment.php');

class MyComment
{
    public function exec()
    {
        session_start();
        if (isset($_SESSION['id_user']) && isset($_SESSION['status']) && isset($_SESSION['status']) === true && $_SESSION['id_user'] != '') {
            $Comment = new CommentRepository();
            $Comment->con = new BDD();
            $User = new UserRepository();
            $User->con = new BDD();
            $resUser = $User->getUserById($_SESSION['id_user']);
            $resCom = $Comment->getMeComment($_SESSION['id_user']);
            if ($resCom !== false && $resUser !== false) {
                require_once(__DIR__ . '/../../templates/mycomment.php');
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
