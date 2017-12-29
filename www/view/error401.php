<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php include "template/head.php" ?>
        <link href="<?php echo $root ?>/public/css/error.css" rel="stylesheet">
    </head>
    <body>
        <?php include 'template/header.php' ?>
        <div class='main cols3'>
            <div class='error col-2'>
                <big>401</big>
                <h1>Seuls les utilisateurs connectés peuvent faire ceci...</h1>
                <h2><i>Vous pouvez vous <a href="<?php echo $root ?>/login">connecter</a>, ou <a href="<?php echo $root ?>/register">créer un compte</a>, ou <a href='<?php echo $root ?>'>revenir à l'accueil</a></i></h2>
            </div>
        </div>
    </body>
</html>
