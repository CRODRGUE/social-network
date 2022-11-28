<?php

class Erreur
{
    public function exec($mes)
    {
        if (!empty($mes)) {
            require_once(__DIR__ . '/../../templates/erreur.php');
        } else {
            header("Location: http://localhost/modulePHP/projet_php/index.php");
            exit();
        }
    }
}
