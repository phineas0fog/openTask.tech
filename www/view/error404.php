<?php $root = Config::getInstance()->get('ROOT_URL') ?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php include 'template/head.php' ?>
        <link href="public/css/error.css" rel="stylesheet">
    </head>
    <body>
        <?php include 'template/header.php' ?>
        <div class='main cols3'>
            <div class='error col-2'>
                <big>404</big>
                <h1>Ce que vous cherchez n'est pas là...</h1>
                <h2><i>Vous pouvez <a href='<?php echo $root ?>'>revenir à l'accueil</a>, ou chercher sur <a target='_blank' href='http://duckduckgo.com'>duckduckgo</a> ;)</i></h2>
            </div>
        </div>
    </body>
</html>
