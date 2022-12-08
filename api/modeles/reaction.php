<?php

require_once(__DIR__ . '/../bdd_con.php');

class Reaction
{
    public $id_user;
    public $id_post;
    public $id_react;
    public $pseudo;
}


class ReactionRepository
{

    public BDD $con;

    function addUserReaction($id_post, $id_user, $id_reaction)
    {
        $sql = $this->con->con()->prepare('INSERT INTO `reaction_post`(`id_user`, `id_post`, `id_react`) VALUES (?,?,?)');
        $res = $sql->execute([$id_user, $id_post, $id_reaction]);
        return $res;
    }

    function delUserReaction($id_post, $id_user)
    {
        $sql = $this->con->con()->prepare('DELETE FROM `reaction_post` WHERE `id_user` = ? AND `id_post` = ?');
        $res = $sql->execute([$id_user, $id_post]);
        return $res;
    }


    function updateUserReaction($id_post, $id_user, $id_reaction)
    {
        $sql = $this->con->con()->prepare('UPDATE `reaction_post` SET `id_react`=? WHERE `id_user`=? AND `id_post`=?');
        $res = $sql->execute([$id_reaction, $id_user, $id_post]);
        return $res;
    }

    function getUserReaction($id_user, $id_post)
    {
        $sql = $this->con->con()->prepare('SELECT * FROM `reaction_post` WHERE `id_post`=? AND id_user =?');
        $sql->execute([$id_post, $id_user]);
        $res = $sql->fetch();
        if ($res === false) {
            return false;
        }
        $userReaction = new Reaction();
        $userReaction->id_user = $res['id_user'];
        $userReaction->id_post = $res['id_post'];
        $userReaction->id_react = $res['id_react'];
        return $userReaction;
    }

    function delAllReactionPost($id_post)
    {
        $sql = $this->con->con()->prepare('DELETE FROM `reaction_post` WHERE `id_post` = ?');
        $res = $sql->execute([$id_post]);
        return $res;
    }


    //Supprimer toutes les reactions de l'utilisateur et de ses posts
    function delAllUserReaction($id_user)
    {
        $sql = $this->con->con()->prepare('DELETE FROM `reaction_post` WHERE `id_post` IN((SELECT `id_post` FROM `posts` WHERE `id_user` = ?)) OR `id_user` = ?');
        $res = $sql->execute([$id_user, $id_user]);
        return $res;
    }

    function getAllReaction($id_post, $id_reaction)
    {
        $sql = $this->con->con()->prepare('SELECT r.id_user, r.id_post, r.id_react, u.pseudo FROM `reaction_post` as r JOIN users as u ON u.id_user = r.id_user WHERE `id_post`=? AND id_react =?');
        $sql->execute([$id_post, $id_reaction]);
        $res = $sql->fetchAll();
        if ($res === false) {
            return false;
        }

        $usersReaction = [];
        foreach ($res as $e) {
            $userReaction = new Reaction();
            $userReaction->id_user = $e['id_user'];
            $userReaction->pseudo = $e['pseudo'];
            $userReaction->id_post = $e['id_post'];
            $userReaction->id_react = $e['id_react'];
            $usersReaction[] = $userReaction;
        }
        return $usersReaction;
    }
}
