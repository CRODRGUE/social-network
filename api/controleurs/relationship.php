<?php

require_once(__DIR__ . '/../bdd_con.php');
require_once(__DIR__ . '/../modeles/user.php');
require_once(__DIR__ . '/../modeles/friend.php');


class Relationship
{
    public function exec()
    {
        session_start();
        if (isset($_SESSION['id_user']) && isset($_SESSION['status']) && isset($_SESSION['status']) === true && $_SESSION['id_user'] != '') {
            $Friend = new FriendRepository;
            $User = new UserRepository();
            $User->con = $Friend->con = new BDD();
            $resUser = $User->getUserById($_SESSION['id_user']);
            $resFriend = $Friend->getUserFriends($_SESSION['id_user']);
            $resAllUser = $User->getNewUser($_SESSION['id_user']);
            $resRequest = $Friend->getUserFriendsRequest($_SESSION['id_user']);
            if ($resRequest !== false && $resAllUser !== false && $resFriend !== false && $resUser !== false) {
                require_once(__DIR__ . '/../../templates/relationship.php');
            } else {
                $mes = 'Oupss une erreur c\'est produite... friend';
                header("Location: http://localhost/modulePHP/projet_php/index?action=err&mes=" . $mes);
                exit();
            }
        } else {
            header("Location: http://localhost/modulePHP/projet_php/index?action=err&mes=connexion");
            exit();
        }
    }
}
