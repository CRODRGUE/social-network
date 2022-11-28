<?php

require_once(__DIR__ . '/../bdd_con.php');

class Friend
{
    public string $pseudo;
    public $id_user;
    public $id_user_friend;
    public $status;
}


class FriendRepository
{
    public BDD $con;

    // Liste d'amis de l'utilisateur (status = 2) --
    function getUserFriends($id_user)
    {
        $sql = $this->con->con()->prepare('SELECT *, (SELECT pseudo FROM `users` WHERE id_user = `follow`.id_user_1) as pseudo FROM `follow` WHERE `id_user` = ? AND `status` = ?');
        $sql->execute([$id_user, 2]);
        $res = $sql->fetchAll();
        if ($res !== false) {
        }
        $friends = [];
        foreach ($res as $e) {
            $friend = new Friend();
            $friend->id_user = $e['id_user'];
            $friend->id_user_friend = $e['id_user_1'];
            $friend->status = $e['status'];
            $friend->pseudo = $e['pseudo'];
            $friends[] = $friend;
        }
        return $friends;
    }
    // Liste des demandes d'amis pour l'utilisateur (status = 1) --
    function getUserFriendsRequest($id_user)
    {
        $sql = $this->con->con()->prepare('SELECT *,(SELECT pseudo FROM `users` WHERE id_user = `follow`.id_user) as pseudo  FROM `follow` WHERE `id_user_1` = ? AND `status` = ?');
        $sql->execute([$id_user, 1]);
        $res = $sql->fetchAll();
        if ($res !== false) {
        }
        $friends = [];
        foreach ($res as $e) {
            $friend = new Friend();
            $friend->id_user = $e['id_user'];
            $friend->id_user_friend = $e['id_user_1'];
            $friend->status = $e['status'];
            $friend->pseudo = $e['pseudo'];
            $friends[] = $friend;
        }
        return $friends;
    }
    // Liste des demandes d'amis effectuer par l'utilisateur (status = 1)
    function getUserRequest($id_user)
    {
        $sql = $this->con->con()->prepare('SELECT *, (SELECT pseudo FROM `users` WHERE id_user = `follow`.id_user_1) as pseudo FROM `follow` WHERE `id_user` = ? AND `status` = ?');
        $sql->execute([$id_user, 1]);
        $res = $sql->fetchAll();
        if ($res !== false) {
        }
        $friends = [];
        foreach ($res as $e) {
            $friend = new Friend();
            $friend->id_user = $e['id_user'];
            $friend->id_user_friend = $e['id_user_1'];
            $friend->status = $e['status'];
            $friend->pseudo = $e['pseudo'];
            $friends[] = $friend;
        }
        return $friends;
    }

    // intialise la demande d'ami
    function createFriendRequest($id_user, $id_user_friend)
    {
        $sql = $this->con->con()->prepare('INSERT INTO `follow`(`id_user`, `id_user_1`, `status`) VALUES (?,?,?)');
        $res = $sql->execute([$id_user, $id_user_friend, 1]);
        return $res;
    }

    // supprime la relation
    function deleteFriend($id_user, $id_user_friend)
    {
        $sql = $this->con->con()->prepare('DELETE FROM `follow` WHERE `id_user` = ? AND `id_user_1` = ? AND `status` = ?');
        $res = $sql->execute([$id_user, $id_user_friend, 2]);
        return $res;
    }

    //supprime la demande (en cas de refus)
    function deleteFriendRequest($id_user, $id_user_friend)
    {
        $sql = $this->con->con()->prepare('DELETE FROM `follow` WHERE `id_user` = ? AND `id_user_1` = ? AND `status` = ?');
        $res = $sql->execute([$id_user_friend, $id_user, 1]);
        return $res;
    }
    //cree le lien entre le demandeur et la cible
    function acceptFriendRequest($id_user, $id_user_friend)
    {
        $sql = $this->con->con()->prepare('INSERT INTO `follow`(`id_user`, `id_user_1`, `status`) VALUES (?,?,?)');
        $res = $sql->execute([$id_user, $id_user_friend, 2]);
        return $res;
    }
    //update la demande en accepter (status = 2)
    function updateFriendRequest($id_user, $id_user_friend)
    {
        $sql = $this->con->con()->prepare('UPDATE `follow` SET `status`= ? WHERE `id_user` = ? AND `id_user_1` = ? AND `status` = ?');
        $res = $sql->execute([2, $id_user, $id_user_friend, 1]);
        return $res;
    }
}
