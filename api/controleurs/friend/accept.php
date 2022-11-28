<?php

require_once(__DIR__ . '/../../bdd_con.php');
require_once(__DIR__ . '/../../modeles/friend.php');


class AcceptFriendRequest
{
    public function exec(array $data)
    {
        session_start();
        if (isset($_SESSION['id_user']) && isset($_SESSION['status']) && $_SESSION['status'] === true && $_SESSION['id_user'] !== '') {
            if (!empty($data['id_user']) && !empty($data['id_friend'])) {
                $Friend = new FriendRepository();
                $Friend->con = new BDD();
                $resFriend0 = $Friend->updateFriendRequest($data['id_friend'], $data['id_user']);
                if ($resFriend0 !== false) {
                    $resFriend = $Friend->acceptFriendRequest($data['id_user'], $data['id_friend']);
                    if ($resFriend !== false) {
                        header("Location: http://http://localhost/modulePHP/projet_php/index?action=relation");
                        exit();
                    } else {
                        $mes = 'Oupss une erreur c\'est produite...';
                        header("Location: http://localhost/modulePHP/projet_php/index?action=err&mes=" . $mes);
                        exit();
                    }
                } else {
                    $mes = 'Oupss une erreur c\'est produite...';
                    header("Location: http://localhost/modulePHP/projet_php/index?action=err&mes=" . $mes);
                    exit();
                }
            } else {
                $mes = 'Oupss une erreur c\'est produite... les données envoyées sont incorrectes';
                header("Location: http://localhost/modulePHP/projet_php/index?action=err&mes=" . $mes);
                exit();
            }
        } else {
            header("Location: http://localhost/modulePHP/projet_php/index?action=connexion");
            exit();
        }
    }
}
