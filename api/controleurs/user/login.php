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
                $res = $User->getUserByMail(strtolower($identifiant));
                if ($res !== false && check($res->mail, strtolower($identifiant)) && check($res->pwd, $pwd)) {
                    session_start();
                    $_SESSION['status'] = true;
                    $_SESSION['id_user'] = $res->id_user;
                    $this->addLog($res->id_user, $_SERVER);
                    header("Location: http://localhost/modulePHP/projet_php/index?action=home");
                    exit();
                }
            } else {
                $res = $User->getUserByPseudo($identifiant);
                if ($res !== false && check($res->pseudo, $identifiant) && check($res->pwd, $pwd)) {
                    session_start();
                    $_SESSION['status'] = true;
                    $_SESSION['id_user'] = $res->id_user;
                    $this->addLog($res->id_user, $_SERVER);
                    header("Location: http://localhost/modulePHP/projet_php/index?action=home&page=0");
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

    function addLog($user, $req)
    {
        $date =  date("Y-m-d H:i:s");
        $fichier = fopen((__DIR__ . '/../../../logs/login.txt'), "a");
        fputs($fichier, 'login // date ' . $date . ' // id_user ' . $user . ' // ip ' . $req['REMOTE_ADDR'] . PHP_EOL);
        fclose($fichier);
    }
}

function check($data0, $data1)
{
    if ($data0 === $data1) {
        return true;
    }
    return false;
}
