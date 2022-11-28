<?php

class UserLogout
{
    public function exec()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: http://localhost/modulePHP/projet_php/index?action=connexion");
        exit();
    }
}
