<?php $titre = "DELTA - Login" ?>
<?php $style = 'login.css' ?>

<?php ob_start(); ?>
<main class="block">
    <div class="block_logo">
        <img class="logo_form" src="../projet_php/asset/logo.png" alt="Logo du reseau social" />
        <p>Le premier réseau social qui te permet de rester informé</p>
    </div>

    <div class="block_form">
        <?php if (!empty($err)) {
            echo '<p class="erreur">' . $err . '</p>';
        } ?>
        <form action="http://localhost/modulePHP/projet_php/index.php?action=login" method="POST">
            <h3>Connexion</h3>
            <div class="form">
                <div class="block_input">
                    <input class="input_res" type="text" id="identifiant" name="identifiant" placeholder="indiquer votre identifiant..." />
                    <label class="label_res" for="identifiant">Identifiant</label>
                </div>

                <div class="block_input">
                    <input class="input_res" type="password" id="pwd" name="pwd" minlength="8" maxlength="20" placeholder="indiquer votre mot de pass..." />
                    <label class="label_res" for="pwd">Mot de pass</label>
                </div>
                <button class="form_btn" type="submit">Valider</button>
            </div>

            <a class="form_btn" href="http://localhost/modulePHP/projet_php/index?action=inscription">Inscription</a>

        </form>
    </div>
</main>
<?php $corps = ob_get_clean();
require(__DIR__ . '/index.php') ?>