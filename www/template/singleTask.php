

<link href="<?php echo $root ?>/public/css/task.css" rel="stylesheet">

<div class='task card'>
    <div class='taskHead'>
        <h1 class='title'> <?php echo $task->name; ?> <small>@ <?php echo $project[0]->title ?> </small></h1>
        <?php if(!is_null($task->maxDate)): ?>
        <p class='maxDate'>
            <?php echo $task->maxDate; ?>
        </p>
        <?php endif ?>
        <?php
            switch($task->priority) {
                case 0:
                    echo "<div class='priority prLow'></div><span class='card prioPop'>Priorité : basse</span>";
                    break;
                case 1:
                    echo "<div class='priority prNor'></div><span class='card prioPop'>Priorité : normale</span>";
                    break;
                case 2:
                    echo "<div class='priority prImp'></div><span class='card prioPop'>Priorité : importante</span>";
                    break;
                case 3:
                    echo "<div class='priority prCri'></div><span class='card prioPop'>Priorité : critique</span>";
                    break;
            }
         ?>
    </div>

    <p class='descr'>
        <?php echo $task->description; ?>
    </p>

    <div class='btnArea'>
        <button class="btn-small btn-details" onclick="document.getElementById('<?php echo 'task#' . $task->id ?>').classList.toggle('show')">Détails</button>
        <a href="<?php echo $root ?>/task/del/<?php echo $task->id ?>" class='btn-small btn-delete'>Supprimer</a>
        <a href="<?php echo $root ?>/task/state/<?php echo $task->id ?>" class='btn-small btn-change'>Change</a>
    </div>
    <?php include 'template/details.php' ?>
</div>
