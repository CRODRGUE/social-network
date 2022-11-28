<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if (isset($style)) {
        $link = "http://localhost/modulePHP/projet_php/asset/css/" . $style;
        echo "<link rel=\"stylesheet\" href=\"$link\">";
    } ?>
    <link rel="icon" href="http://localhost/modulePHP/projet_php/asset/logo_page.png">
    <title><?= $titre ?></title>
</head>

<body>
    <?= $corps ?>
</body>

</html>