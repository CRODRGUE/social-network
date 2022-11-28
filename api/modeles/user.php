<?php
require_once(__DIR__ . '/../bdd_con.php');

class User
{
    public $id_user;
    public string $pseudo;
    public string $mail;
    public string $pwd;
}
class UserRepository
{
    public BDD $con;

    public function addUser(string $pseudo, string $mail, string $pwd)
    {
        $sql = $this->con->con()->prepare('INSERT INTO `users`( `pseudo`, `mail`, `pwd`) VALUES (?,?,?)');
        $hashPwd = hash('sha256', $pwd);
        $res = $sql->execute([$pseudo, $mail, $hashPwd]);
        return $res;
    }

    public function delUser($id_user)
    {
        $sql = $this->con->con()->prepare('DELETE FROM `users` WHERE `id_user` = ?');
        $res = $sql->execute([$id_user]);
        return $res;
    }

    public function getUserById($id_user)
    {
        $sql = $this->con->con()->prepare('SELECT `id_user`,`pseudo`, `mail`, `pwd` FROM `users` WHERE `id_user` = ?');
        $res = $sql->execute([$id_user]);
        $res = $sql->fetch();
        if ($res === false) {
            return false;
        }
        $user = new User();
        $user->id_user = $res['id_user'];
        $user->pseudo = $res['pseudo'];
        $user->mail = $res['mail'];
        $user->pwd = $res['pwd'];
        return $user;
    }

    public function getUserByMail(string $mail)
    {
        $sql = $this->con->con()->prepare('SELECT `id_user`,`pseudo`, `mail`, `pwd` FROM `users` WHERE `mail` = ?');
        $res = $sql->execute([$mail]);
        $res = $sql->fetch();
        if ($res === false) {
            return false;
        }
        $user = new User();
        $user->id_user = $res['id_user'];
        $user->pseudo = $res['pseudo'];
        $user->mail = $res['mail'];
        $user->pwd = $res['pwd'];
        return $user;
    }

    public function getUserByPseudo(string $pseudo)
    {
        $sql = $this->con->con()->prepare('SELECT `id_user`,`pseudo`, `mail`, `pwd` FROM `users` WHERE `pseudo` = ?');
        $res = $sql->execute([$pseudo]);
        $res = $sql->fetch();
        if ($res === false) {
            return false;
        }
        $user = new User();
        $user->id_user = $res['id_user'];
        $user->pseudo = $res['pseudo'];
        $user->mail = $res['mail'];
        $user->pwd = $res['pwd'];
        return $user;
    }

    public function getAllUser($id_user)
    {
        $sql = $this->con->con()->prepare('SELECT `id_user`,`pseudo` FROM `users` WHERE id_user NOT IN(?)');
        $res = $sql->execute([$id_user]);
        $res = $sql->fetchAll();
        if ($res === false) {
            return false;
        }
        $users = [];
        foreach ($res as $e) {
            $user = new User();
            $user->id_user = $e['id_user'];
            $user->pseudo = $e['pseudo'];
            $users[] = $user;
        }
        return $users;
    }

    public function getNewUser($id_user)
    {
        $sql = $this->con->con()->prepare('SELECT `id_user`,`pseudo` FROM `users` WHERE id_user NOT IN((SELECT `id_user_1` FROM `follow` WHERE `id_user` = ? AND `status` = 1)) 
                                            AND id_user NOT IN((SELECT `id_user_1` FROM `follow` WHERE `id_user` = ? AND `status` = 2)) 
                                            AND id_user NOT IN((SELECT `id_user` FROM `follow` WHERE `id_user_1` = ? AND `status` = 1)) 
                                            AND id_user NOT IN(?)');
        $res = $sql->execute([$id_user, $id_user, $id_user, $id_user]);
        $res = $sql->fetchAll();
        if ($res === false) {
            return false;
        }
        $users = [];
        foreach ($res as $e) {
            $user = new User();
            $user->id_user = $e['id_user'];
            $user->pseudo = $e['pseudo'];
            $users[] = $user;
        }

        return $users;
    }
}
