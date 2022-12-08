<?php
require_once(__DIR__ . '/../../modeles/user.php');
require_once(__DIR__ . '/../../modeles/post.php');
require_once(__DIR__ . '/../../modeles/comment.php');
require_once(__DIR__ . '/../../modeles/reaction.php');
require_once(__DIR__ . '/../../modeles/friend.php');
require_once(__DIR__ . '/../../bdd_con.php');

class UserDelete
{
    public function exec($id_del)
    {
        session_start();
        if (isset($_SESSION['id_user']) && isset($_SESSION['status']) && $_SESSION['status'] === true && $_SESSION['id_user'] !== '') {
            if (!empty($id_del) && $id_del === $_SESSION['id_user']) {
                $User = new UserRepository();
                $Post = new PostRepository();
                $Comment = new CommentRepository();
                $React = new ReactionRepository();
                $Friend = new FriendRepository();
                $User->con = $Post->con = $Comment->con = $React->con = $Friend->con = new BDD();
                $resComment = $Comment->deleteAllCommentUser($_SESSION['id_user']);
                $resReact = $React->delAllUserReaction($_SESSION['id_user']);
                $resPost = $Post->deleteAllUserPost($_SESSION['id_user']);
                $resFriend = $Friend->deleteAllUserFriend($_SESSION['id_user']);
                $resUser = $User->delUser($_SESSION['id_user']);
                if ($resComment !== false && $resReact !== false && $resPost !== false && $resFriend !== false && $resUser !== false) {
                    $this->addLog($_SESSION['id_user'], $_SERVER);
                    header("Location: http://localhost/modulePHP/projet_php/index?action=logout");
                    exit();
                } else {
                    $mes = 'Impossible d\'effectuer cette action...';
                    header("Location: http://localhost/modulePHP/projet_php/index?action=err&mes=" . $mes);
                    exit();
                }
            } else {
                $mes = 'Impossible d\'effectuer cette action... vous n\'êtes pas le propriétaire de ce compte';
                header("Location: http://localhost/modulePHP/projet_php/index?action=err&mes=" . $mes);
                exit();
            }
        } else {
            header("Location: http://localhost/modulePHP/projet_php/index?action=connexion");
            exit();
        }
    }

    function addLog($user, $req)
    {
        $date =  date("Y-m-d H:i:s");
        $fichier = fopen((__DIR__ . '/../../../logs/delete_user.txt'), "a");
        fputs($fichier, 'delete // date ' . $date . ' // id_user ' . $user . ' // ip ' . $req['REMOTE_ADDR'] . PHP_EOL);
        fclose($fichier);
    }
}
