<?php $titre = " -  Erreur" ?>
<?php $style = 'erreur.css' ?>
<?php ob_start(); ?>
<div class="err_block">
    <p><?= $mes ?></p>
    <a class="btn_back" href="http://localhost/modulePHP/projet_php/index?action=home&page=0">Acceuil</a>
</div>


<?php $corps = ob_get_clean(); ?>
<?php require(__DIR__ . '/index.php') ?>