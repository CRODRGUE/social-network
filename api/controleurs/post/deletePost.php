<?php

require_once(__DIR__ . '/../../bdd_con.php');
require_once(__DIR__ . '/../../modeles/post.php');
require_once(__DIR__ . '/../../modeles/comment.php');
require_once(__DIR__ . '/../../modeles/reaction.php');

class DeletePost
{
    public function exec(array $data)
    {
        session_start();
        if (isset($_SESSION['id_user']) && isset($_SESSION['status']) && $_SESSION['status'] === true && $_SESSION['id_user'] !== '') {
            if (!empty($data['id_post'])  && !empty($data['id']) && $_SESSION['id_user'] === $data['id']) {
                $Post = new PostRepository();
                $Comments = new CommentRepository();
                $React = new ReactionRepository();
                $Post->con = $Comments->con = $React->con = new BDD();
                $resPost = $Post->deletePost($data['id_post'], $_SESSION['id_user']);
                if ($resPost !== false) {
                    $resComments = $Comments->deleteAllCommentPost($data['id_post']);
                    $resReact = $React->delAllReactionPost($data['id_post']);
                    if ($resComments !== false && $resReact !== false) {
                        header("Location: http://localhost/modulePHP/projet_php/index?action=" . (isset($data['dir']) ? "mesposts" : "home&page=0"));
                        exit();
                    }
                }
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
