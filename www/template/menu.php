<link rel="stylesheet" href="<?php echo $root ?>/public/css/menu.css">

<div class="dropMenu rHead">
 <button onclick="dropMenu()" class="dropbtn"><img src="<?php echo $root ?>/public/img/threelines.png" class='menu'></img></button>
 <div id="dropdown" class="dropdown-content">
    <a href="about">À propos</a>
    <?php if(isset($_SESSION['userId'])) :?>
    <a href="#">Paramètres</a>
        <hr>
        <a href="<?php echo $root ?>/logout">Déconnexion</a>
    <?php else : ?>
        <hr>
        <a href="<?php echo $root ?>/register">S'enregistrer</a>
        <a href="<?php echo $root ?>/login">Connexion</a>
    <?php endif ?>
 </div>
</div>
