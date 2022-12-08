<?php

class UserLogout
{
    public function exec()
    {
        session_start();
        $this->addLog($_SERVER['id_user'], $_SERVER);
        session_unset();
        session_destroy();
        header("Location: http://localhost/modulePHP/projet_php/index?action=connexion");
        exit();
    }

    function addLog($user, $req)
    {
        $date =  date("Y-m-d H:i:s");
        $fichier = fopen((__DIR__ . '/../../../logs/logout.txt'), "a");
        fputs($fichier, 'logout // date ' . $date . ' // id_user ' . $user . ' // ip ' . $req['REMOTE_ADDR'] . PHP_EOL);
        fclose($fichier);
    }
}
