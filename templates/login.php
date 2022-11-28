<?php $titre = "DELTA - Login" ?>
<?php $style = 'login.css' ?>

<?php ob_start(); ?>
<div class="block_form">
    <img class="logo_form" src="../projet_php/asset/logo.png" alt="Logo du reseau social" />
    <?php if (!empty($err)) {
        echo '<p class="erreur">' . $err . '</p>';
    } ?>
    <form action="http://localhost/modulePHP/projet_php/index.php?action=login" method="POST">
        <div class="block_input">
            <label class="label_res" for="identifiant">Identifiant</label>
            <input class="input_res" type="text" id="identifiant" name="identifiant" placeholder="indiquer votre identifiant..." />
        </div>

        <div class="block_input">
            <label class="label_res" for="pwd">Mot de pass</label>
            <input class="input_res" type="password" id="pwd" name="pwd" minlength="8" maxlength="20" placeholder="indiquer votre mot de pass..." />
        </div>
        <div class="form_nav">
            <button class="form_btn" type="submit">Connexion</button>
            <a class="form_btn" href="http://localhost/modulePHP/projet_php/index?action=inscription">Inscription</a>
        </div>
    </form>
</div>
<?php $corps = ob_get_clean();
require(__DIR__ . '/index.php') ?>