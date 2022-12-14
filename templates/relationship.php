<?php $titre = "DELTA - Mes Relations" ?>
<?php $style = 'relationship.css' ?>

<?php ob_start(); ?>
<header class="header_block">
    <a href="http://localhost/modulePHP/projet_php/index?action=home"><img src="http://localhost/modulePHP/projet_php/asset/logo.png" alt="logo du reseau social delat"></a>
    <div class="profile_block">
        <img src="http://localhost/modulePHP/projet_php/asset/profile-user.png" alt="image de profile">
        <a href="http://localhost/modulePHP/projet_php/index?action=profil"><?= $resUser->pseudo ?></a>
    </div>
</header>
<div class="center_block">
    <div class="cb_left">
        <div class="nav_block">
            <a class="nav_option" href="http://localhost/modulePHP/projet_php/index?action=relation">MES RELATIONS</a>
            <a class="nav_option" href="http://localhost/modulePHP/projet_php/index?action=mesposts">MES POSTES</a>
            <a class="nav_option" href="http://localhost/modulePHP/projet_php/index?action=mescom">MES COMMENTAIRES</a>
        </div>

        <a class="btn_deco" href="http://localhost/modulePHP/projet_php/index?action=logout">DECONNEXION</a>
    </div>


    <div class="cb_right">
        <div class="cbr_nav">
            <p class="btn_navr on">Mes relations</p>
            <p class="btn_navr">Mes demandes</p>
            <p class="btn_navr">Nouvelles demandes</p>
            <p class="btn_navr">Nouvelles relation</p>
        </div>
        <div class="cbr_block on">
            <?php
            if (!empty($resFriend)) {
                foreach ($resFriend as $e) { ?>
                    <div class="user_block">
                        <div class="user_info">
                            <img src="./../projet_php/asset/profile-user.png" alt="image de profil">
                            <p><?= $e->pseudo ?></p>
                        </div>
                        <div class="user_nav">
                            <a href="http://localhost/modulePHP/projet_php/index?action=deletefriend&id_friend=<?= $e->id_user_friend ?>" onclick=" return confirm('voulez-vous vraiment supprimer cet ami ?')">Supprimer</a>
                        </div>
                    </div>
            <?php }
            } else {
                echo '<h3>vous n\'avez pas encore de relations</h3>';
            } ?>
        </div>

        <div class=" cbr_block">
            <?php
            if (!empty($resRequestUser)) {
                foreach ($resRequestUser as $e) { ?>
                    <div class=" user_block">
                        <div class="user_info">
                            <img src="./../projet_php/asset/profile-user.png" alt="image de profil">
                            <p><?= $e->pseudo ?></p>
                        </div>
                        <div class="user_nav">
                            <a href="http://localhost/modulePHP/projet_php/index?action=deleteuserrequest&id_friend=<?= $e->id_user_friend ?>" onclick=" return confirm('voulez-vous vraiment annuler la demande ?')">Annuler</a>
                        </div>
                    </div>
            <?php }
            } else {
                echo '<h3>vous n\'avez pas de demandes en cours</h3>';
            } ?>
        </div>

        <div class=" cbr_block">
            <?php
            if (!empty($resRequest)) {
                foreach ($resRequest as $e) { ?>
                    <div class=" user_block">
                        <div class="user_info">
                            <img src="./../projet_php/asset/profile-user.png" alt="image de profil">
                            <p><?= $e->pseudo ?></p>
                        </div>
                        <div class="user_nav">
                            <a href="http://localhost/modulePHP/projet_php/index?action=acceptfriendrequest&id_friend=<?= $e->id_user ?>">Accepter</a>
                            <a href="http://localhost/modulePHP/projet_php/index?action=deletefriendrequest&id_friend=<?= $e->id_user ?>" onclick=" return confirm('voulez-vous vraiment decliner cette demande d\'ami ?')">Decliner</a>
                        </div>
                    </div>
            <?php }
            } else {
                echo '<h3>vous n\'avez pas de nouvelles demandes</h3>';
            } ?>
        </div>

        <div class=" cbr_block">
            <?php if (!empty($resAllUser)) {
                foreach ($resAllUser as $e) { ?>
                    <div class=" user_block">
                        <div class="user_info">
                            <img src="./../projet_php/asset/profile-user.png" alt="image de profil">
                            <p><?= $e->pseudo ?></p>
                        </div>
                        <div class="user_nav">
                            <a href="http://localhost/modulePHP/projet_php/index?action=friendrequest&id_friend=<?= $e->id_user ?>">Ajouter</a>
                        </div>
                    </div>
            <?php }
            } else {
                echo '<h3>vous ??tes d??j?? en relation avec tout le monde</h3>';
            } ?>
        </div>

    </div>
</div>
<a class=" btn_add" href="http://localhost/modulePHP/projet_php/index?action=home#ancre">+</a>


<script>
    const btn = document.querySelectorAll('.btn_navr')
    const block = document.querySelectorAll('.cbr_block')
    btn.forEach(element => {
        let changeBlock = function() {
            btn.forEach((e, i) => {
                if (e == this) {
                    e.classList.add('on')
                    block[i].classList.add('on')
                } else {
                    e.classList.remove('on')
                    block[i].classList.remove('on')
                }
            })
        }
        element.addEventListener("click", changeBlock)
    });
</script>
<?php $corps = ob_get_clean();
require(__DIR__ . '/index.php') ?>