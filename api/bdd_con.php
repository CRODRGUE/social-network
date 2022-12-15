<?php
class BDD
{
    public ?\PDO $bdd = null;

    public function con(): \PDO
    {
        if ($this->bdd === null) {
            $this->bdd = new \PDO('mysql:host=mysql;dbname=reseau_social0', 'root', 'test');
        }
        return $this->bdd;
    }
}
