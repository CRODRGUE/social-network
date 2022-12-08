<?php $titre = "DELTA - Home" ?>
<?php $style = 'home.css' ?>

<?php ob_start(); ?>
<header class="header_block">
    <img src="http://localhost/modulePHP/projet_php/asset/logo.png" alt="logo du reseau social delat">
    <div class="profile_block">
        <img src="http://localhost/modulePHP/projet_php/asset/profile-user.png" alt="image de profile">
        <a href="http://localhost/modulePHP/projet_php/index?action=profil"><?= $resUser->pseudo ?></a>
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
        <form class="block_add_post" action="http://localhost/modulePHP/projet_php/index?action=addpost" method="POST">
            <span id="ancre"></span>
            <h3>Nouveau post</h3>
            <div>
                <input type="text" name="text_post" minlength="2" maxlength="400" placeholder="Publie un nouveau post...">
                <button type="submit"></button>
            </div>
        </form>
        <?php foreach ($resPost as $e) { ?>
            <article class="post_block">
                <div class="post_user">
                    <img src="http://localhost/modulePHP/projet_php/asset/profile-user.png" alt="imge de profil du propietaire">
                    <a href="">
                        <?= $e->user_pseudo ?>
                    </a>
                    <p class="test"> // <?= $e->date_post ?></p>
                </div>
                <p class="text_post">
                    <?= $e->text_post ?>
                </p>
                <div class="post_footer">
                    <div class="reaction_block">
                        <div class="reaction">
                            <?php
                            if ($e->user_react !== null && $e->user_react === '1') {
                                echo '<a href="http://localhost/modulePHP/projet_php/index?action=delreact&id_post=' . $e->id_post . '&dir=home&page=' . $page . '"><img src="http://localhost/modulePHP/projet_php/asset/like_on.png" alt="reaction like activée"></a>';
                            } else {
                                echo '<a href="http://localhost/modulePHP/projet_php/index?action=addreact&id_post=' . $e->id_post . '&id_react=1&dir=home&page=' . $page . '"><img src="http://localhost/modulePHP/projet_php/asset/like_off.png" alt="reaction like"></a>';
                            }
                            ?>
                            <p><?= $e->nbr_like ?></p>
                        </div>
                        <div class="reaction">
                            <?php
                            if ($e->user_react !== null && $e->user_react === '2') {
                                echo '<a href="http://localhost/modulePHP/projet_php/index?action=delreact&id_post=' . $e->id_post . '&dir=home&page=' . $page . '"><img src="http://localhost/modulePHP/projet_php/asset/fav_on.png" alt="reaction j\'adore activée"></a>';
                            } else {
                                echo '<a href="http://localhost/modulePHP/projet_php/index?action=addreact&id_post=' . $e->id_post . '&id_react=2&dir=home&page=' . $page . '"><img src="http://localhost/modulePHP/projet_php/asset/fav_off.png" alt="reaction j\'adore"></a>';
                            }
                            ?>
                            <p><?= $e->nbr_jadore ?></p>
                        </div>
                        <div class="reaction">
                            <?php
                            if ($e->user_react !== null && $e->user_react === '3') {
                                echo '<a href="http://localhost/modulePHP/projet_php/index?action=delreact&id_post=' . $e->id_post . '&dir=home&page=' . $page . '"><img src="http://localhost/modulePHP/projet_php/asset/dislike_on.png" alt="reaction dislike activée"></a>';
                            } else {
                                echo '<a href="http://localhost/modulePHP/projet_php/index?action=addreact&id_post=' . $e->id_post . '&id_react=3&dir=home&page=' . $page . '"><img src="http://localhost/modulePHP/projet_php/asset/dislike_off.png" alt="reaction dislike"></a>';
                            }
                            ?>
                            <p><?= $e->nbr_dislike ?></p>
                        </div>
                    </div>
                    <a class="btn_nav" href="http://localhost/modulePHP/projet_php/index?action=post&id=<?= $e->id_post ?>">Voir le post</a>
                </div>
            </article>
        <?php } ?>
        <section class="nav_page">
            <?php
            $page_prev = $page - 1;
            if ($page_prev <= 0) {
                echo '<a class="btn_page" href="http://localhost/modulePHP/projet_php/index?action=home&page=0">Page precedente</a>';
            } else {
                echo '<a class="btn_page" href="http://localhost/modulePHP/projet_php/index?action=home&page=' . $page_prev . '">Page precedente</a>';
            }
            ?>
            <p><?= $page ?></p>
            <?php
            $page_next = $page + 1;
            if (count($resPost) < 10) {
                echo '<a class="btn_disabled btn_page" href="http://localhost/modulePHP/projet_php/index?action=home">Page precedente</a>';
            } else {
                echo '<a class="btn_page" href="http://localhost/modulePHP/projet_php/index?action=home&page=' . $page_next . '">Page Suivante</a>';
            }
            ?>
        </section>
    </section>
</main>

<a class="btn_add" href="#ancre">+</a>
<?php $corps = ob_get_clean();
require(__DIR__ . '/index.php') ?>