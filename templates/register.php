<?php $titre = "DELTA - Register" ?>
<?php $style = 'register.css' ?>

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
        <form action="http://localhost/modulePHP/projet_php/index.php?action=register" method="POST">
            <h3>Isncription</h3>
            <div class="form">
                <div class="block_input">
                    <input class="input_res" type="text" id="pseudo" name="pseudo" minlength="1" maxlength="20" pattern="*[a-z-A-Z-0-9]" placeholder="indiquer votre pseudo..." require />
                    <label class="label_res" for="pseudo">Pseudo</label>
                </div>
                <div class="block_input">
                    <input class="input_res" type="email" id="mail" name="mail" placeholder="indiquer votre mail..." require />
                    <label class="label_res" for="mail">E-mail</label>
                </div>
                <div class="block_input">
                    <input class="input_res" type="password" id="pwd" name="pwd" minlength="8" maxlength="20" placeholder="indiquer votre mot de pass..." require />
                    <label class="label_res" for="pwd">Mot de pass</label>
                </div>
                <div class="block_input">
                    <input class="input_res" type="password" id="pwd_conf" name="pwd_conf" minlength="8" maxlength="20" placeholder="indiquer votre mot de pass..." require />
                    <label class="label_res" for="pwd_conf">Confirmation du mot de pass</label>
                </div>
                <button class="form_btn" type="submit">Valider</button>
            </div>

            <a class="form_btn" href="http://localhost/modulePHP/projet_php/index?action=connexion">Retour</a>

        </form>
    </div>
</main>
<?php $corps = ob_get_clean();
require(__DIR__ . '/index.php') ?>