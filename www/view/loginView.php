<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php include 'template/head.php' ?>
        <link href="public/css/login.css" rel="stylesheet">
        <link href="public/css/form.css" rel="stylesheet">
        <link href="public/css/buttons.css" rel="stylesheet">
    </head>
    <body>
        <?php include 'template/header.php' ?>
    <div class='main'>
        <div id='login'>
            <form action='checkLogin' method="post" class='loginForm card'>
                <h1>Connexion</h1>
                <ul>
                    <li><input type='text' placeholder="Pseudo" name='name' required></li>
                    <li><input type='password' placeholder="Mot de passe" name='password' required></li>
                                        <br>
                    <li><input type="submit" class='btn-small' value='Valider'></li>
                </ul>
            </form>
        </div>
    </div>
    </body>
</html>
