<?php

require_once(__DIR__ . '/../../bdd_con.php');
require_once(__DIR__ . '/../../modeles/user.php');
require_once(__DIR__ . '/../../modeles/post.php');
require_once(__DIR__ . '/../../modeles/comment.php');
require_once(__DIR__ . '/../../modeles/reaction.php');

class PostDisplay
{
    public function exec($id_post)
    {
        session_start();
        if (isset($_SESSION['id_user']) && isset($_SESSION['status']) && $_SESSION['status'] === true && $_SESSION['id_user'] !== '') {
            if (!empty($id_post)) {
                $User = new UserRepository();
                $Post = new PostRepository();
                $Comment = new CommentRepository();
                $Reaction = new ReactionRepository();
                $User->con = $Post->con = $Comment->con = $Reaction->con = new BDD();
                $resUser = $User->getUserById($_SESSION['id_user']);
                $resPost = $Post->getPostById($id_post, $_SESSION['id_user']);
                $resComment = $Comment->getCommentPost($id_post);
                $UserReaction = $Reaction->getUserReaction($_SESSION['id_user'], $id_post);
                $ListDislike = $Reaction->getAllReaction($id_post, 3);
                $ListJadore = $Reaction->getAllReaction($id_post, 2);
                $ListLike = $Reaction->getAllReaction($id_post, 1);
                if ($resPost !== false && $resUser !== false && $resComment !== false) {
                    require_once(__DIR__ . '/../../../templates/post.php');
                }
            } else {
                $mes = 'Oupss une erreur c\'est produite... l\'element demandé n\'existe pas';
                header("Location: http://localhost/modulePHP/projet_php/index?action=err&mes=" . $mes);
                exit();
            }
        } else {
            header("Location: http://localhost/modulePHP/projet_php/index?action=connexion");
            exit();
        }
    }
}
