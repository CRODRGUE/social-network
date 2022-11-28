<?php
require_once(__DIR__ . '/../../bdd_con.php');
require_once(__DIR__ . '/../../modeles/user.php');

class addUser
{
    function exec(array $data)
    {
        if (!empty($data['pseudo']) && !empty($data['mail']) && !empty($data['pwd']) && preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))/i', $data['mail'])) {
            $pseudo = $data['pseudo'];
            $mail = $data['mail'];
            $pwd = $data['pwd'];
            $User = new UserRepository();
            $User->con = new BDD();
            $res = $User->addUser($pseudo, $mail, $pwd);
            if ($res !== false) {
                header("Location: http://localhost/modulePHP/projet_php/index?action=connexion");
                exit();
            } else {
                $mes = 'Il y a un probleme avec les données indiquer peseudo ou email déjà indisponible...';
                header("Location: http://localhost/modulePHP/projet_php/index?action=inscription&mes=" . $mes);
                exit();
            }
        } else {
            $mes = 'il manque des données...';
            header("Location: http://localhost/modulePHP/projet_php/index?action=err&mes=" . $mes);
            exit();
        }
    }
}
