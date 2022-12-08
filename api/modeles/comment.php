<?php
require_once(__DIR__ . '/../bdd_con.php');

class Comment
{
    public $id_com;
    public string $text_com;
    public $date_com;
    public $id_post;
    public $id_user;
    public $user_pseudo;
}

class CommentRepository
{
    public BDD $con;

    //Recupere la liste des commentaires emis par l'utilisateur
    function getMeComment($id_user)
    {
        $sql = $this->con->con()->prepare('SELECT *, (SELECT pseudo FROM `users` WHERE id_user = `commentaires`.id_user) as user_pseudo FROM `commentaires` WHERE `id_user` = ? ORDER BY `date_com` DESC');
        $sql->execute([$id_user]);
        $res = $sql->fetchAll();
        if ($res === false) {
            return false;
        }
        $comments = [];
        foreach ($res as $e) {
            $comment = new Comment();
            $comment->id_com = $e['id_com'];
            $comment->text_com = $e['text_com'];
            $comment->date_com = $e['date_com'];
            $comment->id_post = $e['id_post'];
            $comment->id_user = $e['id_user'];
            $comment->user_pseudo = $e['user_pseudo'];
            $comments[] = $comment;
        }
        return $comments;
    }

    //Recupere la liste des commentaires d'un post
    function getCommentPost($id_post)
    {
        $sql = $this->con->con()->prepare('SELECT *,(SELECT pseudo FROM `users` WHERE id_user = `commentaires`.id_user) as user_pseudo FROM `commentaires` WHERE `id_post` = ? ORDER BY `date_com` DESC');
        $sql->execute([$id_post]);
        $res = $sql->fetchAll();
        if ($res === false) {
            return false;
        }
        $comments = [];
        foreach ($res as $e) {
            $comment = new Comment();
            $comment->id_com = $e['id_com'];
            $comment->text_com = $e['text_com'];
            $comment->date_com = $e['date_com'];
            $comment->id_post = $e['id_post'];
            $comment->id_user = $e['id_user'];
            $comment->user_pseudo = $e['user_pseudo'];
            $comments[] = $comment;
        }
        return $comments;
    }

    //Creation d'un commentaire rattaché à un post/utilisateur
    function createComment($id_post, $id_user, $text_com)
    {
        $sql = $this->con->con()->prepare('INSERT INTO `commentaires`(`text_com`, `date_com`, `id_post`, `id_user`)  VALUES (?,?,?,?)');
        $date_com =  date("Y-m-d H:i:s");
        $res = $sql->execute([$text_com, $date_com, $id_post, $id_user]);
        return $res;
    }

    //Supprimer un commentaire
    function deleteComment($id_com)
    {
        $sql = $this->con->con()->prepare('DELETE FROM `commentaires` WHERE `id_com` = ?');
        $res = $sql->execute([$id_com]);
        return $res;
    }

    //Supprimer tous les commentaires d'un post
    function deleteAllCommentPost($id_post)
    {
        $sql = $this->con->con()->prepare('DELETE FROM `commentaires` WHERE `id_post` = ?');
        $res = $sql->execute([$id_post]);
        return $res;
    }

    //Supprimer tous les commentaires d'un utilisateur et de ses posts
    function deleteAllCommentUser($id_user)
    {
        $sql = $this->con->con()->prepare('DELETE FROM `commentaires` WHERE id_post IN((SELECT id_post FROM posts WHERE id_user = ?)) OR id_user = ?');
        $res = $sql->execute([$id_user, $id_user]);
        return $res;
    }
}
