<?php $titre = " -  Erreur" ?>
<?php $style = 'erreur.css' ?>
<?php ob_start(); ?>
<p><?= $mes ?></p>


<?php $corps = ob_get_clean(); ?>
<?php require(__DIR__ . '/index.php') ?>