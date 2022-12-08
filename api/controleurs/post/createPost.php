<?php

require_once(__DIR__ . '/../../bdd_con.php');
require_once(__DIR__ . '/../../modeles/post.php');

class PostCreate
{
    public function exec($text_post)
    {
        session_start();
        if (isset($_SESSION['id_user']) && isset($_SESSION['status']) && $_SESSION['status'] === true && $_SESSION['id_user'] !== '') {
            if (!empty($text_post) && strlen($text_post) <= 400 & strlen($text_post) >= 2) {
                $Post = new PostRepository();
                $Post->con = new BDD();
                $resPost = $Post->createPost($text_post, $_SESSION['id_user']);
                if ($resPost !== false) {
                    header("Location: http://localhost/modulePHP/projet_php/index?action=home");
                    exit();
                }
            } else {
                $mes = 'Oupss une erreur c\'est produite... les données envoyer sont incorrectes' . strlen($text_post);
                header("Location: http://localhost/modulePHP/projet_php/index?action=err&mes=" . $mes);
                exit();
            }
        } else {
            header("Location: http://localhost/modulePHP/projet_php/index?action=connexion");
            exit();
        }
    }
}
