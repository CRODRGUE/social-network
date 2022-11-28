<?php

require_once(__DIR__ . '/api/controleurs/homepage.php');
require_once(__DIR__ . '/api/controleurs/user/register.php');
require_once(__DIR__ . '/api/controleurs/inscription.php');
require_once(__DIR__ . '/api/controleurs/user/login.php');
require_once(__DIR__ . '/api/controleurs/connexion.php');
require_once(__DIR__ . '/api/controleurs/user/logout.php');
// import des controleurs pour les amis
require_once(__DIR__ . '/api/controleurs/friend/accept.php');
require_once(__DIR__ . '/api/controleurs/friend/deleteFriend.php');
require_once(__DIR__ . '/api/controleurs/friend/deleteResquest.php');
require_once(__DIR__ . '/api/controleurs/friend/request.php');
require_once(__DIR__ . '/api/controleurs/relationship.php');

require_once(__DIR__ . '/api/controleurs/home.php');
require_once(__DIR__ . '/api/controleurs/post/post.php');
require_once(__DIR__ . '/api/controleurs/post/createPost.php');
require_once(__DIR__ . '/api/controleurs/post/deletePost.php');
require_once(__DIR__ . '/api/controleurs/comment/addComment.php');
require_once(__DIR__ . '/api/controleurs/comment/deleteComment.php');
require_once(__DIR__ . '/api/controleurs/erreur.php');
//http://localhost/modulePHP/projet_php/index

if (isset($_GET['action']) && $_GET['action'] !== '') {
    $route = $_GET['action'];
    //route pour la vue de la connexion ==
    if ($route === 'connexion') {
        ((new Connexion)->exec($_GET));
        //route pour la vue de l'inscription ==
    } elseif ($route === 'inscription') {
        ((new Inscription)->exec($_GET));
        //route pour le traitement des données indiquer à l'inscription (backend) ==
    } elseif ($route === 'register') {
        ((new addUser)->exec($_POST));
        //route pour le traitement des données indiquer à la connexion (backend) ==
    } elseif ($route === 'login') {
        ((new UserLogin)->exec($_POST));
        //route pour la deconnexion ==
    } elseif ($route === 'logout') {
        ((new UserLogout)->exec());
    } elseif ($route === 'home') {
        ((new Home)->exec());
        //route pour consulter un post ==
    } elseif ($route === 'post') {
        ((new PostDisplay)->exec($_GET['id']));
        //route pour creer un post 
    } elseif ($route === 'addpost') {
        ((new PostCreate)->exec($_POST['text_post']));
    } elseif ($route === 'delpost') {
        ((new DeletePost)->exec($_GET));
        //route pour ajouter un commentaire à un post ==
    } elseif ($route === 'addcomment') {
        ((new CommentAdd)->exec($_POST, $_GET['id']));
    } elseif ($route === 'delcomment') {
        ((new DeleteComment)->exec($_GET));
    } elseif ($route === 'err') {
        ((new Erreur)->exec($_GET['mes']));
    }





    // à verifier !!!!!!!!!!!!!!!!!!!!
    elseif ($route === 'relation') {
        ((new Relationship)->exec());
    } elseif ($route === 'friendrequest') {
        ((new MakeFriendRequest)->exec($_GET));
    } elseif ($route === 'acceptfriendrequest') {
        ((new AcceptFriendRequest)->exec($_GET));
    } elseif ($route === 'deletefriendrequest') {
        ((new DeleteFriendRequest)->exec($_GET));
    } elseif ($route === 'deletefriend') {
        ((new DeleteFriend)->exec($_GET));
    }
} else {
    ((new Homepage)->exec());
}
