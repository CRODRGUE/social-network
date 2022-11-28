<?php

require_once(__DIR__ . '/../bdd_con.php');

class Post
{
    public $id_post;
    public string $text_post;
    public $date_post;
    public $id_user;
    public string $user_pseudo;
}


class PostRepository
{
    public BDD $con;

    function getAllPost()
    {
        $res = $this->con->con()->query('SELECT * ,(SELECT `pseudo` FROM users WHERE `id_user` = posts.`id_user`) as user_pseudo FROM `posts`');
        if ($res === false) {
            return false;
        }
        $posts = [];
        foreach ($res as $e) {
            $post = new Post();
            $post->id_post = $e['id_post'];
            $post->text_post = $e['text_post'];
            $post->date_post = $e['date_post'];
            $post->id_user = $e['id_user'];
            $post->user_pseudo = $e['user_pseudo'];
            $posts[] = $post;
        }
        return $posts;
    }
    function getPostById($id_post)
    {
        $sql = $this->con->con()->prepare('SELECT * ,(SELECT `pseudo` FROM users WHERE `id_user` = posts.`id_user`) as user_pseudo FROM `posts` WHERE id_post = ?');
        $sql->execute([$id_post]);
        $res = $sql->fetch();
        if ($res === false) {
            return false;
        }
        $post = new Post();
        $post->id_post = $res['id_post'];
        $post->text_post = $res['text_post'];
        $post->date_post = $res['date_post'];
        $post->id_user = $res['id_user'];
        $post->user_pseudo = $res['user_pseudo'];

        return $post;
    }

    function getUserPost($id_user)
    {
        $sql = $this->con->con()->prepare('SELECT * ,(SELECT `pseudo` FROM users WHERE `id_user` = posts.`id_user`) as user_pseudo as user_pseudo FROM `posts` WHERE `id_user` = ?');
        $sql->execute([$id_user]);
        $res = $sql->fetchAll();
        if ($res === false) {
            return false;
        }
        $posts = [];
        foreach ($res as $e) {
            $post = new Post();
            $post->id_post = $e['id_post'];
            $post->text_post = $e['text_post'];
            $post->date_post = $e['date_post'];
            $post->id_user = $e['id_user'];
            $post->user_pseudo = $e['user_pseudo'];
            $posts[] = $post;
        }
        return $posts;
    }

    function getUserFreindPost($id_user)
    {
        $sql = $this->con->con()->prepare('SELECT *, ,(SELECT `pseudo` FROM users WHERE `id_user` = posts.`id_user`) as user_pseudo FROM `posts` WHERE `id_user` IN(SELECT id_user_1 FROM `follow` WHERE `id_user` = ?)');
        $sql->execute([$id_user]);
        $res = $sql->fetchAll();
        if ($res === false) {
            return false;
        }
        $posts = [];
        foreach ($res as $e) {
            $post = new Post();
            $post->id_post = $e['id_post'];
            $post->text_post = $e['text_post'];
            $post->date_post = $e['date_post'];
            $post->id_user = $e['id_user'];
            $post->user_pseudo = $e['user_pseudo'];
            $posts[] = $post;
        }
        return $posts;
    }

    function createPost($text_post, $id_user)
    {
        $sql = $this->con->con()->prepare('INSERT INTO `posts`(`text_post`, `date_post`, `id_user`) VALUES (?,?,?)');
        $date_post =  date("Y-m-d H:i:s");
        $res = $sql->execute([$text_post, $date_post, $id_user]);
        return $res;
    }

    function deletePost($id_post)
    {
        $sql = $this->con->con()->prepare('DELETE FROM `posts` WHERE `id_post` = ?');
        $res = $sql->execute([$id_post]);
        return $res;
    }

    function deleteAllUserPost($id_user)
    {
        $sql = $this->con->con()->prepare('DELETE FROM `posts` WHERE `id_user` = ?');
        $res = $sql->execute([$id_user]);
        return $res;
    }
}
