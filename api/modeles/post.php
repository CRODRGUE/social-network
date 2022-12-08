<?php

require_once(__DIR__ . '/../bdd_con.php');

class Post
{
    public $id_post;
    public string $text_post;
    public $date_post;
    public $id_user;
    public string $user_pseudo;
    public $nbr_like;
    public $nbr_jadore;
    public $nbr_dislike;
    public $user_react;
}


class PostRepository
{
    public BDD $con;

    function getAllPost($id_user, int $page)
    {
        $sql = $this->con->con()->prepare('SELECT * ,
            (SELECT `pseudo` FROM users WHERE `id_user` = posts.`id_user`) as user_pseudo, 
            (SELECT COUNT(id_user) FROM `reaction_post` as r  WHERE `id_post`= posts.id_post AND id_react =1) as nbr_like, 
            (SELECT COUNT(id_user) FROM `reaction_post` as r  WHERE `id_post`= posts.id_post AND id_react =2) as nbr_jadore,
            (SELECT COUNT(id_user) FROM `reaction_post` as r  WHERE `id_post`= posts.id_post AND id_react =3) as nbr_dislike, 
            (SELECT id_react FROM reaction_post WHERE id_post= posts.id_post AND id_user = :id) as user_react 
            FROM `posts` ORDER BY `date_post` DESC LIMIT 10 OFFSET :offset ;');
        $sql->bindValue(':offset', intval($page * 10), PDO::PARAM_INT);
        $sql->bindValue(':id', $id_user, PDO::PARAM_STR);
        $sql->execute();
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
            $post->nbr_like = $e['nbr_like'];
            $post->nbr_jadore = $e['nbr_jadore'];
            $post->nbr_dislike = $e['nbr_dislike'];
            $post->user_react = $e['user_react'];
            $posts[] = $post;
        }
        return $posts;
    }
    function getPostById($id_post, $id_user)
    {
        $sql = $this->con->con()->prepare('SELECT * ,
                (SELECT `pseudo` FROM users WHERE `id_user` = posts.`id_user`) as user_pseudo, 
                (SELECT COUNT(id_user) FROM `reaction_post` as r  WHERE `id_post`= posts.id_post AND id_react =1) as nbr_like, 
                (SELECT COUNT(id_user) FROM `reaction_post` as r  WHERE `id_post`= posts.id_post AND id_react =2) as nbr_jadore,
                (SELECT COUNT(id_user) FROM `reaction_post` as r  WHERE `id_post`= posts.id_post AND id_react =3) as nbr_dislike, 
                (SELECT id_react FROM reaction_post WHERE id_post= posts.id_post AND id_user = ?) as user_react 
                FROM `posts` WHERE id_post = ?');
        $sql->execute([$id_user, $id_post]);
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
        $post->nbr_like = $res['nbr_like'];
        $post->nbr_jadore = $res['nbr_jadore'];
        $post->nbr_dislike = $res['nbr_dislike'];
        $post->user_react = $res['user_react'];
        return $post;
    }

    function getUserPost($id_user)
    {
        $sql = $this->con->con()->prepare('SELECT * ,
        (SELECT `pseudo` FROM users WHERE `id_user` = posts.`id_user`) as user_pseudo, 
        (SELECT COUNT(id_user) FROM `reaction_post` as r  WHERE `id_post`= posts.id_post AND id_react =1) as nbr_like, 
        (SELECT COUNT(id_user) FROM `reaction_post` as r  WHERE `id_post`= posts.id_post AND id_react =2) as nbr_jadore,
        (SELECT COUNT(id_user) FROM `reaction_post` as r  WHERE `id_post`= posts.id_post AND id_react =3) as nbr_dislike, 
        (SELECT id_react FROM reaction_post WHERE id_post= posts.id_post AND id_user = posts.id_user) as user_react 
        FROM `posts` WHERE id_user = ?');
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
            $post->nbr_like = $e['nbr_like'];
            $post->nbr_jadore = $e['nbr_jadore'];
            $post->nbr_dislike = $e['nbr_dislike'];
            $post->user_react = $e['user_react'];
            $posts[] = $post;
        }
        return $posts;
    }

    function getUserFreindPost($id_user, $page)
    {
        $sql = $this->con->con()->prepare('SELECT * ,
            (SELECT `pseudo` FROM users WHERE `id_user` = posts.`id_user`) as user_pseudo, 
            (SELECT COUNT(id_user) FROM `reaction_post` as r  WHERE `id_post`= posts.id_post AND id_react =1) as nbr_like, 
            (SELECT COUNT(id_user) FROM `reaction_post` as r  WHERE `id_post`= posts.id_post AND id_react =2) as nbr_jadore,
            (SELECT COUNT(id_user) FROM `reaction_post` as r  WHERE `id_post`= posts.id_post AND id_react =3) as nbr_dislike, 
            (SELECT id_react FROM reaction_post WHERE id_post= posts.id_post AND id_user = :id_user) as user_react 
            FROM `posts` WHERE `id_user` IN(SELECT id_user_1 FROM `follow` WHERE `id_user` = :id_user AND `status`=2) OR `id_user` = :id_user ORDER BY `date_post` DESC LIMIT 10 OFFSET :offset');
        $sql->bindValue(':offset', intval($page * 10), PDO::PARAM_INT);
        $sql->bindValue(':id_user', $id_user, PDO::PARAM_STR);
        $sql->execute();
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
            $post->nbr_like = $e['nbr_like'];
            $post->nbr_jadore = $e['nbr_jadore'];
            $post->nbr_dislike = $e['nbr_dislike'];
            $post->user_react = $e['user_react'];
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

    function deletePost($id_post, $id_user)
    {
        $sql = $this->con->con()->prepare('DELETE FROM `posts` WHERE `id_post` = ? AND `id_user` = ?');
        $res = $sql->execute([$id_post, $id_user]);
        return $res;
    }

    function deleteAllUserPost($id_user)
    {
        $sql = $this->con->con()->prepare('DELETE FROM `posts` WHERE `id_user` = ?');
        $res = $sql->execute([$id_user]);
        return $res;
    }
}
