<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php include 'template/head.php' ?>
    </head>
    <body>
        <?php include 'template/header.php' ?>
        <div class='main'>
            <div class='bar'>
                <div class='colHead' id='addHead'>Ajout</div>
                <div class='colHead' id='todoHead'>À faire</div>
                <div class='colHead' id='doingHead'>En cours</div>
                <div class='colHead' id='doneHead'>Terminé</div>
            </div>
            <div class='columnContainer'>
                <div id='addContainer' class='colContainer'>
                    <?php include 'template/addTask.php' ?>
                </div>
                <div id='todoContainer' class='colContainer'>
                    <?php
                        foreach ($tasksTodo as $task) {
                            include 'template/singleTask.php';
                        }
                    ?>
                </div>

                <div id='doingContainer' class='colContainer'>
                    <?php
                        foreach ($tasksDoing as $task) {
                            include 'template/singleTask.php';
                        }
                    ?>
                </div>

                <div id='doneContainer' class='colContainer'>
                    <?php
                        foreach ($tasksDone as $task) {
                            include 'template/singleTask.php';
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript">
        <?php include 'public/js/details.js' ?>
    </script>
</html>
