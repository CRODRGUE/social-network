<?php

require_once(__DIR__ . '/../../bdd_con.php');
require_once(__DIR__ . '/../../modeles/user.php');


class UserLogin
{
    function exec(array $input)
    {
        if (!empty($input['identifiant']) && !empty($input['pwd'])) {
            $identifiant = $input['identifiant'];
            $pwd = $input['pwd'];
            $User = new UserRepository();
            $User->con = new BDD();
            $pwd = hash('sha256', $pwd);
            if (strpos($identifiant, '@')) {
                $res = $User->getUserByMail($identifiant);
                if ($res !== false && check($res->mail, $identifiant) && check($res->pwd, $pwd)) {
                    session_start();
                    $_SESSION['status'] = true;
                    $_SESSION['id_user'] = $res->id_user;
                    header("Location: http://localhost/modulePHP/projet_php/index?action=home");
                    exit();
                }
            } else {
                $res = $User->getUserByPseudo($identifiant);
                if ($res !== false && check($res->pseudo, $identifiant) && check($res->pwd, $pwd)) {
                    session_start();
                    $_SESSION['status'] = true;
                    $_SESSION['id_user'] = $res->id_user;
                    header("Location: http://localhost/modulePHP/projet_php/index?action=home");
                    exit();
                }
            }
            $mes = 'Identifiant ou mot de pass incorrect';
            header("Location: http://localhost/modulePHP/projet_php/index?action=connexion&mes=" . $mes);
            exit();
        } else {
            $mes = 'Oupss les données envoyées sont incorrectes...';
            header("Location: http://localhost/modulePHP/projet_php/index?action=err&mes=" . $mes);
            exit();
        }
    }
}

function check($data0, $data1)
{
    if ($data0 === $data1) {
        return true;
    }
    return false;
}
