<?php

require_once(__DIR__ . '/../../bdd_con.php');
require_once(__DIR__ . '/../../modeles/friend.php');

class deleteUserRequest
{
    public function exec(array $data)
    {
        session_start();
        if (isset($_SESSION['id_user']) && isset($_SESSION['status']) && $_SESSION['status'] === true && $_SESSION['id_user'] !== '') {
            if (!empty($data['id_user']) && !empty($data['id_friend'])) {
                $Friend = new FriendRepository();
                $Friend->con = new BDD();
                $resFriend = $Friend->deleteUserRequest($data['id_user'], $data['id_friend']);
                if ($resFriend !== false) {
                    header("Location: http://localhost/modulePHP/projet_php/index?action=relation");
                    exit();
                }
                echo $resFriend;
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
