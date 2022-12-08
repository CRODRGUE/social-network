<?php
// Import controleursdes pages
require_once(__DIR__ . '/api/controleurs/homepage.php');
require_once(__DIR__ . '/api/controleurs/home.php');
require_once(__DIR__ . '/api/controleurs/inscription.php');
require_once(__DIR__ . '/api/controleurs/connexion.php');
require_once(__DIR__ . '/api/controleurs/relationship.php');
require_once(__DIR__ . '/api/controleurs/erreur.php');
require_once(__DIR__ . '/api/controleurs/post/post.php');
require_once(__DIR__ . '/api/controleurs/mypost.php');
require_once(__DIR__ . '/api/controleurs/mycomment.php');
require_once(__DIR__ . '/api/controleurs/profile.php');
// Import des controleurs pour les utilisateurs
require_once(__DIR__ . '/api/controleurs/user/register.php');
require_once(__DIR__ . '/api/controleurs/user/login.php');
require_once(__DIR__ . '/api/controleurs/user/logout.php');
require_once(__DIR__ . '/api/controleurs/user/delete.php');
// Import des controleurs pour les amis
require_once(__DIR__ . '/api/controleurs/friend/accept.php');
require_once(__DIR__ . '/api/controleurs/friend/deleteFriend.php');
require_once(__DIR__ . '/api/controleurs/friend/deleteResquest.php');
require_once(__DIR__ . '/api/controleurs/friend/deleteUserRequest.php');
require_once(__DIR__ . '/api/controleurs/friend/request.php');
// Import des controleurs pour les posts
require_once(__DIR__ . '/api/controleurs/post/createPost.php');
require_once(__DIR__ . '/api/controleurs/post/deletePost.php');
// Import des controleurs pour les commentaires
require_once(__DIR__ . '/api/controleurs/comment/addComment.php');
require_once(__DIR__ . '/api/controleurs/comment/deleteComment.php');
// Import des controleurs pour lesreactions
require_once(__DIR__ . '/api/controleurs/reaction/addReact.php');
require_once(__DIR__ . '/api/controleurs/reaction/delReact.php');

//URL du service
//http://localhost/modulePHP/projet_php/index

if (isset($_GET['action']) && $_GET['action'] !== '') {
    $route = $_GET['action'];

    //=== Routes des pages du service ===
    //Page de connexion
    if ($route === 'connexion') {
        ((new Connexion)->exec($_GET));
    }
    //Page d'inscription
    elseif ($route === 'inscription') {
        ((new Inscription)->exec($_GET));
    }
    //Page d'accueil (feed)
    elseif ($route === 'home') {
        ((new Home)->exec($_GET));
    }
    //Page du post (affichage du post avec commentaire)
    elseif ($route === 'post') {
        ((new PostDisplay)->exec($_GET['id']));
    }
    //Page des relation(demandes en cours, nouvelles de demandes, amis...)
    elseif ($route === 'relation') {
        ((new Relationship)->exec());
    }
    //Page d'erreur
    elseif ($route === 'err') {
        ((new Erreur)->exec($_GET['mes']));
    }
    //Page mes posts
    elseif ($route === 'mesposts') {
        ((new MyPost)->exec());
    }
    //Page mes commentaires
    elseif ($route === 'mescom') {
        ((new MyComment)->exec());
    }
    //Page profil
    elseif ($route === 'profil') {
        ((new Profile)->exec());
    }

    // === Routes des requetes/actions pour la gestion des utilisateurs ===
    //Inscription de l'utilisateur au service
    elseif ($route === 'register') {
        ((new addUser)->exec($_POST));
    }
    //Connexion de l'utilisateur au service
    elseif ($route === 'login') {
        ((new UserLogin)->exec($_POST));
    }
    //Deconnexion de l'utilisateur du service
    elseif ($route === 'logout') {
        ((new UserLogout)->exec());
    }
    //Supprime l'utilisateur du service
    elseif ($route === 'delete') {
        ((new UserDelete)->exec($_GET['id']));
    }


    // === Routes des requetes/actions pour la gestion des posts ===
    //Creer un post 
    elseif ($route === 'addpost') {
        ((new PostCreate)->exec($_POST['text_post']));
    }
    //Supprimer un post
    elseif ($route === 'delpost') {
        ((new DeletePost)->exec($_GET));
    }

    // === Routes des requetes/actions pour la gestion des commentaires ===
    //Ajouter un commentaire à un post
    elseif ($route === 'addcomment') {
        ((new CommentAdd)->exec($_POST, $_GET['id']));
    }
    //Supprimer un commentaire d'un post
    elseif ($route === 'delcomment') {
        ((new DeleteComment)->exec($_GET));
    }

    // === Routes des requetes/actions pour la gestion des reactions ===
    //Ajouter une reaction à un post
    elseif ($route === 'addreact') {
        ((new AddReact)->exec($_GET));
    }
    // Supprimer la reaction d'un post
    elseif ($route === 'delreact') {
        ((new DelReact)->exec($_GET));
    }

    // === Routes des requetes/actions pour la gestion des relations ===
    // Emettre une demande
    elseif ($route === 'friendrequest') {
        ((new MakeFriendRequest)->exec($_GET));
    }
    //Accepter une demande
    elseif ($route === 'acceptfriendrequest') {
        ((new AcceptFriendRequest)->exec($_GET));
    }
    //Decliner une demande
    elseif ($route === 'deletefriendrequest') {
        ((new DeleteFriendRequest)->exec($_GET));
    }
    // Annuler une demande en cours (demande envoyé par l'utilisateur lui-meme)
    elseif ($route === 'deleteuserrequest') {
        ((new DeleteUserRequest)->exec($_GET));
    }
    // Supprimer une relation etablie
    elseif ($route === 'deletefriend') {
        ((new DeleteFriend)->exec($_GET));
    }
}
//Page de redirection en cas de pages introuvables 
else {
    ((new Homepage)->exec());
}
