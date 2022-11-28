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

    function getMeComment($id_user)
    {
        $sql = $this->con->con()->prepare('SELECT *, (SELECT pseudo FROM `users` WHERE id_user = `commentaires`.id_user) as user_pseudo FROM `commentaires` WHERE `id_user` = ?');
        $sql->execute([$id_user]);
        $res = $sql->fetch();
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

    function getCommentPost($id_post)
    {
        $sql = $this->con->con()->prepare('SELECT *,(SELECT pseudo FROM `users` WHERE id_user = `commentaires`.id_user) as user_pseudo FROM `commentaires` WHERE `id_post` = ?');
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

    function createComment($id_post, $id_user, $text_com)
    {
        $sql = $this->con->con()->prepare('INSERT INTO `commentaires`(`text_com`, `date_com`, `id_post`, `id_user`)  VALUES (?,?,?,?)');
        $date_com =  date("Y-m-d H:i:s");
        $res = $sql->execute([$text_com, $date_com, $id_post, $id_user]);
        return $res;
    }

    function deleteComment($id_com)
    {
        $sql = $this->con->con()->prepare('DELETE FROM `commentaires` WHERE `id_com` = ?');
        $res = $sql->execute([$id_com]);
        return $res;
    }

    function deleteAllCommentPost($id_post)
    {
        $sql = $this->con->con()->prepare('DELETE FROM `commentaires` WHERE `id_post` = ?');
        $res = $sql->execute([$id_post]);
        return $res;
    }

    function deleteAllCommentUser($id_user)
    {
        $sql = $this->con->con()->prepare('DELETE FROM `commentaires` WHERE `id_post` = ?');
        $res = $sql->execute([$id_user]);
        return $res;
    }
}
