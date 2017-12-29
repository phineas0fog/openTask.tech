<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php include 'template/head.php' ?>
        <?php include 'template/cookieDisclaimer.php' ?>
        <link href="public/css/breadCrumb.css" rel="stylesheet">
    </head>
    <body>
        <?php include 'template/header.php' ?>
        <div class='bar'>
            <div class='colHead' id='todoHead'>Projets public</div>
            <div class='colHead' id='doingHead'>Projets privés</div>
        </div>
        <div class='main cols4'>
            <div class='pubContainer col-2'>
                <?php include 'template/addProjectPublic.php' ?><br>
                <?php foreach ($projectsPub as $project): ?>
                    <a href="<?php echo $root ?>/public/project/<?php echo $project->id ?>"><div class='card inlineCard'>
                        <h1><?php echo $project->title ?></h1> <a href="<?php echo $root ?>/public/project/del/<?php echo $project->id ?>" class="btn-small btn-delete">Supprimer</a>
                    </div></a>
                <?php endforeach; ?>
            </div>
            <div class='privContainer col-3'>
                <?php if(isset($_SESSION['userId'])): ?>
                    <?php include 'template/addProjectPrivate.php' ?><br>
                    <?php foreach ($projectsPriv as $project): ?>
                        <a href="<?php echo $root ?>/private/project/<?php echo $project->id ?>"><div class='card inlineCard'>
                            <h1><?php echo $project->title ?></h1> <a href="<?php echo $root ?>/public/project/del/<?php echo $project->id ?>" class="btn-small btn-delete">Supprimer</a>
                        </div></a>
                    <?php endforeach; ?>
                <?php endif ?>
            </div>
        </div>
    </body>
</html>
