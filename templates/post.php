<?php $titre = "DELTA - Post" ?>
<?php $style = 'post.css' ?>

<?php ob_start(); ?>
<header class="header_block">
    <a href="http://localhost/modulePHP/projet_php/index?action=home"><img src="http://localhost/modulePHP/projet_php/asset/logo.png" alt="logo du reseau social delat"></a>
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
        <div class="block_contenu">
            <div class="post_block">
                <div class="post_user">
                    <img src="http://localhost/modulePHP/projet_php/asset/profile-user.png" alt="imge de profil du propietaire">
                    <a href=""><?= $resPost->user_pseudo ?></a>
                </div>
                <p>
                    <?= $resPost->text_post ?>
                </p>
                <div class="post_footer">
                    <div class="reaction_block">
                        <div class="reaction">
                            <img src="http://localhost/modulePHP/projet_php/asset/dislike_off.png" alt="reaction off">
                            <p>XX</p>
                        </div>
                        <div class="reaction">
                            <img src="http://localhost/modulePHP/projet_php/asset/dislike_off.png" alt="reaction off">
                            <p>XX</p>
                        </div>
                        <div class="reaction">
                            <img src="http://localhost/modulePHP/projet_php/asset/dislike_off.png" alt="reaction off">
                            <p>XX</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block_input">
                <form action="http://localhost/modulePHP/projet_php/index?action=addcomment&id=<?= $resPost->id_post ?>" method="post">
                    <input type="text" placeholder="ecrivez un commentaire" name="comment">
                    <button type="submit"></button>
                </form>
            </div>
            <div class="comments_block">
                <?php foreach ($resComment as $e) { ?>
                    <div class="comment_block">
                        <div class="comment_user">
                            <img src="http://localhost/modulePHP/projet_php/asset/profile-user.png" alt="imge de profil du propietaire">
                            <div class="test">
                                <a href=""><?= $e->user_pseudo ?></a>
                                <p>// <?= $e->date_com ?></p>
                            </div>
                        </div>
                        <p><?= $e->text_com ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<a class="btn_add" href="http://localhost/modulePHP/projet_php/index?action=home#ancre">+</a>
<?php $corps = ob_get_clean();
require(__DIR__ . '/index.php') ?>