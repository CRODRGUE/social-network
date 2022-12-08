<?php
require_once(__DIR__ . '/../../bdd_con.php');
require_once(__DIR__ . '/../../modeles/reaction.php');

class DelReact
{

    public function exec(array $data)
    {
        session_start();
        if (isset($_SESSION['id_user']) && isset($_SESSION['status']) && $_SESSION['status'] === true && $_SESSION['id_user'] !== '') {
            if (!empty($data['id_post']) && !empty($data['dir'])) {
                $React = new ReactionRepository();
                $React->con = new BDD();
                $resReact = $React->delUserReaction($data['id_post'], $_SESSION['id_user']);
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
