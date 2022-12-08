<?php
class BDD
{
    public ?\PDO $bdd = null;

    public function con(): \PDO
    {
        if ($this->bdd === null) {
            $this->bdd = new \PDO('mysql:host=localhost;dbname=reseau_social0', 'root', '');
        }
        return $this->bdd;
    }
}
