<?php $titre = "DELTA - Mes posts" ?>
<?php $style = 'mypost.css' ?>

<?php ob_start(); ?>
<header class="header_block">
    <a href="http://localhost/modulePHP/projet_php/index?action=home"><img src="http://localhost/modulePHP/projet_php/asset/logo.png" alt="logo du reseau social delat"></a>
    <div class="profile_block">
        <img src="http://localhost/modulePHP/projet_php/asset/profile-user.png" alt="image de profile">
        <a href="http://localhost/modulePHP/projet_php/index?action=profil">
            <?= $resUser->pseudo ?>
        </a>
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
        <?php
        if (!empty($resPost)) {
            foreach ($resPost as $e) {
        ?>
                <div class="post_block">
                    <p class="text_post"><?= $e->text_post ?></p>
                    <div class="post_nav">
                        <a href="http://localhost/modulePHP/projet_php/index?action=post&id=<?= $e->id_post ?>">Voir</a>
                        <a href="http://localhost/modulePHP/projet_php/index?action=delpost&id_post=<?= $e->id_post ?>&id=<?= $resUser->id_user ?>&dir=mesposts" onclick=" return confirm('voulez-vous vraiment supprimer ce post ?')">Sup</a>
                    </div>
                </div>
        <?php
            }
        } else {
            echo '<h3> Vous n\'avez pas encore posté de posts </h3>';
        }
        ?>
    </section>

</main>
<a class="btn_add" href="http://localhost/modulePHP/projet_php/index?action=home#ancre">+</a>
<?php $corps = ob_get_clean();
require(__DIR__ . '/index.php') ?>