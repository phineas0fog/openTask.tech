<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php include 'template/head.php' ?>
        <link href="public/css/login.css" rel="stylesheet">
        <link href="public/css/form.css" rel="stylesheet">
        <link href="public/css/buttons.css" rel="stylesheet">
        <link href="public/css/register.css" rel="stylesheet">
    </head>
    <body>
        <?php include 'template/header.php' ?>
    <div class='main'>
        <div id='login'>
            <form class='loginForm card' action='registerHandl' method='post'>
                <h1>Créer un compte</h1>
                <ul>
                    <li><input type='text' placeholder="Pseudo" name="username" required></li>
                    <li><input type='text' placeholder="Adresse mail" name="mail" required></li>
                    <li><input id='psw' type='password' placeholder="Mot de passe" name="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required></li>
                    <li><input type='password' placeholder="Répéter" name="passVerif" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required></li>
                    <br />
                    <li><input type="submit" class='btn-small' value='Valider'></li>
                </ul>
            </form>
        </div>
        <div id="message" class='card'>
            <h2>Le mot de passe doit contenir :</h2>
            <p id="letter"  class="invalid">Une lettre <b>minuscule</b></p>
            <p id="capital" class="invalid">Une lettre <b>majuscule</b></p>
            <p id="number"  class="invalid">Un <b>chiffre</b></p>
            <p id="length"  class="invalid">Minimum <b>8 caractères</b></p>
        </div>
    </div>
    <script type="text/javascript">
        <?php include 'public/js/register.js' ?>
    </script>
    </body>
</html>
