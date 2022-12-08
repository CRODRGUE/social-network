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
            <article class="post_block">
                <div class="post_header">
                    <div class="post_user">
                        <img src="http://localhost/modulePHP/projet_php/asset/profile-user.png" alt="imge de profil du propietaire">
                        <a href=""><?= $resPost->user_pseudo ?></a>
                    </div>
                    <?php if ($resPost->id_user === $resUser->id_user) {
                        echo '<a class="btn_sup" href="http://localhost/modulePHP/projet_php/index?action=delpost&id_post=' . $resPost->id_post . '&id=' . $resUser->id_user . '" onclick=" return confirm(\'voulez-vous vraiment supprimer ce post ?\')">Sup</a>';
                    } ?>
                </div>
                <p class="text_post">
                    <?= $resPost->text_post ?>
                </p>
                <div class="post_footer">
                    <div class="reaction_block">
                        <div class="reaction">
                            <?php
                            if ($resPost->user_react !== null && $resPost->user_react === '1') {
                                echo '<a href="http://localhost/modulePHP/projet_php/index?action=delreact&id_post=' . $resPost->id_post . '&dir=post"><img src="http://localhost/modulePHP/projet_php/asset/like_on.png" alt="reaction like activée"></a>';
                            } else {
                                echo '<a href="http://localhost/modulePHP/projet_php/index?action=addreact&id_post=' . $resPost->id_post . '&id_react=1&dir=post"><img src="http://localhost/modulePHP/projet_php/asset/like_off.png" alt="reaction like"></a>';
                            }
                            ?>
                            <span class="reaction_nbr">
                                <p><?= $resPost->nbr_like ?></p>
                                <?php if (!empty($ListLike)) { ?>
                                    <ul class="reaction_list">
                                        <?php foreach ($ListLike as $e) { ?>
                                            <li><?= $e->pseudo ?></li>
                                    <?php }
                                    } ?>
                                    </ul>
                            </span>
                        </div>
                        <div class="reaction">
                            <?php
                            if ($resPost->user_react !== null && $resPost->user_react === '2') {
                                echo '<a href="http://localhost/modulePHP/projet_php/index?action=delreact&id_post=' . $resPost->id_post . '&dir=post"><img src="http://localhost/modulePHP/projet_php/asset/fav_on.png" alt="reaction j\'adore activée"></a>';
                            } else {
                                echo '<a href="http://localhost/modulePHP/projet_php/index?action=addreact&id_post=' . $resPost->id_post . '&id_react=2&dir=post"><img src="http://localhost/modulePHP/projet_php/asset/fav_off.png" alt="reaction j\'adore"></a>';
                            }
                            ?>
                            <span class="reaction_nbr">
                                <p><?= $resPost->nbr_jadore ?></p>
                                <?php if (!empty($ListJadore)) { ?>
                                    <ul class="reaction_list">
                                        <?php foreach ($ListJadore as $e) { ?>
                                            <li><?= $e->pseudo ?></li>
                                    <?php }
                                    } ?>
                                    </ul>
                            </span>
                        </div>

                        <div class="reaction">
                            <?php
                            if ($resPost->user_react !== null && $resPost->user_react === '3') {
                                echo '<a href="http://localhost/modulePHP/projet_php/index?action=delreact&id_post=' . $resPost->id_post . '&dir=post"><img src="http://localhost/modulePHP/projet_php/asset/dislike_on.png" alt="reaction dislike activée"></a>';
                            } else {
                                echo '<a href="http://localhost/modulePHP/projet_php/index?action=addreact&id_post=' . $resPost->id_post . '&id_react=3&dir=post"><img src="http://localhost/modulePHP/projet_php/asset/dislike_off.png" alt="reaction dislike"></a>';
                            }
                            ?>
                            <span class="reaction_nbr">
                                <p><?= $resPost->nbr_dislike ?></p>
                                <?php if (!empty($ListDislike)) { ?>
                                    <ul class="reaction_list">
                                        <?php foreach ($ListDislike as $e) { ?>
                                            <li><?= $e->pseudo ?></li>
                                    <?php }
                                    } ?>
                                    </ul>
                            </span>
                        </div>
                    </div>
                </div>
            </article>
            <div class="block_input">
                <form action="http://localhost/modulePHP/projet_php/index?action=addcomment&id=<?= $resPost->id_post ?>" method="post">
                    <input type="text" minlength="1" maxlength="120" placeholder="ecrivez un commentaire" name="comment">
                    <button type="submit"></button>
                </form>
            </div>
            <div class="comments_block">
                <?php foreach ($resComment as $e) { ?>
                    <div class="comment_block">
                        <div class="comment_header">
                            <div class="comment_user">
                                <img src="http://localhost/modulePHP/projet_php/asset/profile-user.png" alt="imge de profil du propietaire">
                                <div class="test">
                                    <a href=""><?= $e->user_pseudo ?></a>
                                    <p>// <?= $e->date_com ?></p>
                                </div>
                            </div>
                            <?php if ($e->id_user === $resUser->id_user) {
                                echo '<a class="btn_sup" href="http://localhost/modulePHP/projet_php/index?action=delcomment&id_com=' . $e->id_com . '&id_post=' . $e->id_post . '&id=' . $resUser->id_user . '" onclick=" return confirm(\'voulez-vous vraiment supprimer ce commentaire ?\')">Sup</a>';
                            } ?>
                        </div>
                        <p class="text_com"><?= $e->text_com ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
</main>
<a class="btn_add" href="http://localhost/modulePHP/projet_php/index?action=home#ancre">+</a>
<?php $corps = ob_get_clean();
require(__DIR__ . '/index.php') ?>