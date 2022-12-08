<?php
require_once(__DIR__ . '/../../bdd_con.php');
require_once(__DIR__ . '/../../modeles/reaction.php');

class AddReact
{

    public function exec(array $data)
    {
        session_start();
        if (isset($_SESSION['id_user']) && isset($_SESSION['status']) && $_SESSION['status'] === true && $_SESSION['id_user'] !== '') {
            if (!empty($data['id_post']) && !empty($data['id_react']) && !empty($data['dir'])) {
                $React = new ReactionRepository();
                $React->con = new BDD();
                $checkReact = $React->getUserReaction($_SESSION['id_user'], $data['id_post']);
                if ($checkReact === false) {
                    $resReact = $React->addUserReaction($data['id_post'], $_SESSION['id_user'], $data['id_react']);
                } else {
                    $resReact = $React->updateUserReaction($data['id_post'], $_SESSION['id_user'], $data['id_react']);
                }
                if ($resReact !== false) {
                    header('Location: http://localhost/modulePHP/projet_php/index?action=' . ($data['dir'] === 'post' ? 'post&id=' . $data['id_post'] : 'home&page=' . $data['page']));
                    exit();
                }
                $mes = 'Oupss une erreur c\'est produite...';
                header("Location: http://localhost/modulePHP/projet_php/index?action=err&mes=" . $mes);
                exit();
            } else {
                $mes = 'Oupss une erreur c\'est produite... les données envoyer sont incorrectes';
                header("Location: http://localhost/modulePHP/projet_php/index?action=err&mes=" . $mes);
                exit();
            }
        } else {
            header("Location: http://localhost/modulePHP/projet_php/index?action=connexion");
            exit();
        }
    }
}
