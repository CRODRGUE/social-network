<?php
class Inscription
{
    public function exec(array $data)
    {
        if (isset($data['mes'])) {
            $err = $data['mes'];
        }
        require_once(__DIR__ . '/../../templates/register.php');
    }
}
