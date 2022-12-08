<?php $titre = "DELTA - Profil" ?>
<?php $style = 'profile.css' ?>

<?php ob_start(); ?>
<header class="header_block">
    <a href="http://localhost/modulePHP/projet_php/index?action=home"><img src="http://localhost/modulePHP/projet_php/asset/logo.png" alt="logo du reseau social delat"></a>
    <div class="profile_block">
        <img src="http://localhost/modulePHP/projet_php/asset/profile-user.png" alt="image de profile">
        <a href="/"><?= $resUser->pseudo ?></a>
    </div>
</header>
<main class="center_block">
    <section class="cb_left">
        <nav class="nav_block">
            <a class="nav_option" href="http://localhost/modulePHP/projet_php/index?action=relation">MES RELATIONS</a>
            <a class="nav_option" href="http://localhost/modulePHP/projet_php/index?action=mesposts">MES POSTES</a>
            <a class="nav_option" href="http://localhost/modulePHP/projet_php/index?action=mescom">MES COMMENTAIRES</a>
        </nav>
        <a class="btn_deco" href="http://localhost/modulePHP/projet_php/index?action=logout">DECONNEXION</a>
    </section>

    <section class="cb_right">
        <div class="block_contenu">
            <div>
                <div class="block_profile">
                    <img src="http://localhost/modulePHP/projet_php/asset/profile-user.png" alt="image de profile">
                    <a href="/"><?= $resUser->pseudo ?></a>
                </div>
                <p><?= $resUser->mail ?></p>
            </div>
            <a class="btn_sup" href="http://localhost/modulePHP/projet_php/index?action=delete&id=<?= $resUser->id_user ?>" onclick="return confirm('voulez-vous vraiment supprimer votre compte ?')">Sup</a>
        </div>
    </section>
</main>
<a class="btn_add" href="http://localhost/modulePHP/projet_php/index?action=home#ancre">+</a>
<?php $corps = ob_get_clean();
require(__DIR__ . '/index.php') ?>