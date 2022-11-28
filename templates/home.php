<?php $titre = "DELTA - Home" ?>
<?php $style = 'home.css' ?>

<?php ob_start(); ?>
<header class="header_block">
    <img src="http://localhost/modulePHP/projet_php/asset/logo.png" alt="logo du reseau social delat">
    <div class="profile_block">
        <img src="http://localhost/modulePHP/projet_php/asset/profile-user.png" alt="image de profile">
        <a href=""><?= $resUser->pseudo ?></a>
    </div>
</header>
<div class="center_block">
    <div class="cb_left">
        <div class="nav_block">
            <a class="nav_option" href="http://localhost/modulePHP/projet_php/index?action=relation">MES RELATIONS</a>
            <a class="nav_option" href="">MES POSTES</a>
            <a class="nav_option" href="">MES COMMENTAIRES</a>
        </div>

        <a class="btn_deco" href="http://localhost/modulePHP/projet_php/index?action=logout">DECONNEXION</a>
    </div>

    <div class="cb_right">
        <form class="block_add_post" action="http://localhost/modulePHP/projet_php/index?action=addpost" method="POST">
            <span id="ancre"></span>
            <h3>Nouveau post</h3>
            <div>
                <input type="text" name="text_post">
                <button type="submit"></button>
            </div>
        </form>
        <?php foreach ($resPost as $e) { ?>
            <div class="post_block">
                <div class="post_user">
                    <img src="http://localhost/modulePHP/projet_php/asset/profile-user.png" alt="imge de profil du propietaire">
                    <a href="">
                        <?= $e->user_pseudo ?>
                    </a>
                    <p class="test"> // <?= $e->date_post ?></p>
                </div>
                <p>
                    <?= $e->text_post ?>
                </p>
                <div class="post_footer">
                    <div class="reaction_block">
                        <div class="reaction">
                            <img src="http://localhost/modulePHP/projet_php/asset/like_on" alt="reaction off">
                            <p>1</p>
                        </div>
                        <div class="reaction">
                            <img src="http://localhost/modulePHP/projet_php/asset/fav_off.png" alt="reaction off">
                            <p>15</p>
                        </div>
                        <div class="reaction">
                            <img src="http://localhost/modulePHP/projet_php/asset/dislike_off.png" alt="reaction off">
                            <p>0</p>
                        </div>
                    </div>
                    <a class="btn_nav" href="http://localhost/modulePHP/projet_php/index?action=post&id=<?= $e->id_post ?>">Voir le post</a>
                </div>
            </div>
        <?php } ?>
    </div>

    <a class="btn_add" href="#ancre">+</a>
    <?php $corps = ob_get_clean();
    require(__DIR__ . '/index.php') ?>