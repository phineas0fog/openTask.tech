<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php include "template/head.php" ?>
        <link href="<?php echo $root ?>/public/css/error.css" rel="stylesheet">
        <link href="<?php echo $root ?>/public/css/500.css" rel="stylesheet">
    </head>
    <body>
        <?php include 'template/header.php' ?>
        <div class='main cols3'>
            <div class='error col-2'>
                <big>500</big>
                <h1>Le serveur a rencontré un erreur...</h1>
                <h2><i><a href='<?php echo $root ?>'>revenir à l'accueil</a><br/>
                Vous pouvez mous aider en prévenant le <a href="mailto:e.vanespen@protonmail.com">webmaster</a></i></h2>
            </div>
        </div>
    </body>
</html>
