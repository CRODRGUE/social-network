<?php $titre = "DELTA - Register" ?>
<?php $style = 'register.css' ?>

<?php ob_start(); ?>
<div class="block_form">
    <img class="logo_form" src="../projet_php/asset/logo.png" alt="Logo du reseau social" />
    <?php if (!empty($err)) {
        echo '<p class="erreur">' . $err . '</p>';
    } ?>
    <form action="http://localhost/modulePHP/projet_php/index.php?action=register" method="POST">
        <div class="block_input">
            <label class="label_res" for="pseudo">Pseudo</label>
            <input class="input_res" type="text" id="pseudo" name="pseudo" minlength="1" maxlength="20" pattern="*[a-z-A-Z-0-9]" placeholder="indiquer votre pseudo..." />
        </div>
        <div class="block_input">
            <label class="label_res" for="mail">E-mail</label>
            <input class="input_res" type="email" id="mail" name="mail" placeholder="indiquer votre mail..." />
        </div>
        <div class="block_input">
            <label class="label_res" for="pwd">Mot de pass</label>
            <input class="input_res" type="password" id="pwd" name="pwd" minlength="8" maxlength="20" placeholder="indiquer votre mot de pass..." />
        </div>
        <div class="form_nav">
            <button class="form_btn" type="submit">Inscription</button>
            <a class="form_btn" href="http://localhost/modulePHP/projet_php/index?action=connexion">Retour</a>
        </div>
    </form>
</div>
<?php $corps = ob_get_clean();
require(__DIR__ . '/index.php') ?>