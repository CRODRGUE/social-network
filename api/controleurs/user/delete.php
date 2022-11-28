<?php
require_once(__DIR__ . '/../../modeles/user.php');
require_once(__DIR__ . '/../../bdd_con.php');

class UserDelete
{
    public function exec($id_del)
    {
        session_start();
        if (isset($_SESSION['id_user']) && isset($_SESSION['status']) && $_SESSION['status'] === true && $_SESSION['id_user'] !== '') {
            if (!empty($id_del) && $id_del === $_SESSION['id_user']) {
                $User = new UserRepository();
                $User->con = new BDD();
                $res = $User->delUser($id_del);
                if ($res !== false) {
                    header("Location: http://localhost/modulePHP/note/index.php");
                    exit();
                } else {
                    $mes = 'Impossible d\'effectuer cette action...';
                    header("Location: http://localhost/modulePHP/note/index.php?action=err&mes=" . $mes);
                    exit();
                }
            } else {
                $mes = 'Impossible d\'effectuer cette action... vous n\'êtes pas le propriétaire de ce compte';
                header("Location: http://localhost/modulePHP/note/index.php?action=err&mes=" . $mes);
                exit();
            }
        } else {
            header("Location: http://localhost/modulePHP/projet_php/index?action=connexion");
            exit();
        }
    }
}
