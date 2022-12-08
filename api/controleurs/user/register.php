<?php
require_once(__DIR__ . '/../../bdd_con.php');
require_once(__DIR__ . '/../../modeles/user.php');

class addUser
{
    function exec(array $data)
    {
        if (!empty($data['pseudo']) && 1 <= strlen($data['pseudo']) && strlen($data['pseudo']) <= 20 && !empty($data['mail']) && !empty($data['pwd']) && !empty($data['pwd_conf']) && preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))/i', $data['mail'])) {
            $pseudo = $data['pseudo'];
            $mail = strtolower($data['mail']);
            $pwd = $data['pwd'];
            $pwd_conf = $data['pwd_conf'];
            if ($pwd_conf === $pwd) {
                $User = new UserRepository();
                $User->con = new BDD();
                $res = $User->addUser($pseudo, $mail, $pwd);
                if ($res !== false) {
                    $this->addLog($pseudo, $mail, $_SERVER);
                    header("Location: http://localhost/modulePHP/projet_php/index?action=connexion");
                    exit();
                } else {
                    $mes = 'Il y a un probleme avec les données indiquées peseudo ou email indisponible...';
                    header("Location: http://localhost/modulePHP/projet_php/index?action=inscription&mes=" . $mes);
                    exit();
                }
            } else {
                $mes = 'Mot de pass pas identique...';
                header("Location: http://localhost/modulePHP/projet_php/index?action=inscription&mes=" . $mes);
                exit();
            }
        } else {
            $mes = 'Il manque des données...';
            header("Location: http://localhost/modulePHP/projet_php/index?action=err&mes=" . $mes);
            exit();
        }
    }

    function addLog($user_pseudo, $user_mail, $req)
    {
        $date =  date("Y-m-d H:i:s");
        $fichier = fopen((__DIR__ . '/../../../logs/register.txt'), "a");
        fputs($fichier, 'register // date ' . $date . ' // user info ' . $user_pseudo . ' ' . $user_mail . ' // ip ' . $req['REMOTE_ADDR'] . PHP_EOL);
        fclose($fichier);
    }
}
