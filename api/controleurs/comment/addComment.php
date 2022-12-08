<?php
require_once(__DIR__ . '/../../bdd_con.php');
require_once(__DIR__ . '/../../modeles/comment.php');

class CommentAdd
{
    public function exec(array $input, $id_post)
    {
        session_start();
        if (isset($_SESSION['status']) && isset($_SESSION['id_user']) && $_SESSION['status'] === true && $_SESSION['id_user'] !== '') {
            if (!empty($id_post) && isset($input['comment']) && !empty($input['comment']) && strlen($input['comment']) <= 120 && strlen($input['comment']) >= 1) {
                $Comment = new CommentRepository();
                $Comment->con = new BDD();
                $res = $Comment->createComment($id_post, $_SESSION['id_user'], $input['comment']);
                if ($res !== false) {
                    header("Location: http://localhost/modulePHP/projet_php/index?action=post&id=" . $id_post);
                    exit();
                }
            }
            $mes = 'Oupss... impossible d\'effectuer cette demande';
            header("Location: http://localhost/modulePHP/projet_php/index?action=err&mes=" . $mes);
            exit();
        } else {
            header("Location: http://localhost/modulePHP/projet_php/index?action=connexion");
            exit();
        }
    }
}
