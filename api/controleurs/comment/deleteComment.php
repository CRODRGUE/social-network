<?php
require_once(__DIR__ . '/../../bdd_con.php');
require_once(__DIR__ . '/../../modeles/comment.php');

class DeleteComment
{
    public function exec(array $data)
    {
        session_start();
        if (isset($_SESSION['id_user']) && isset($_SESSION['status']) && $_SESSION['status'] === true && $_SESSION['id_user'] !== '') {
            if (!empty($data['id_post']) && !empty($data['id_com'])) {
                $Comments = new CommentRepository();
                $Comments->con = new BDD();
                $resComments = $Comments->deleteComment($data['id_com']);
                if ($resComments !== false) {
                    header("Location: http://localhost/modulePHP/projet_php/index?action=post&id=" . $data['id_post'] . "\"");
                    exit();
                }
                $mes = 'Oupss une erreur c\'est produite...';
                header("Location: http://localhost/modulePHP/projet_php/index?action=err&mes=" . $mes);
                exit();
            }
        } else {
            header("Location: http://localhost/modulePHP/projet_php/index?action=connexion");
            exit();
        }
    }
}
