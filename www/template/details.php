<link href="<?php echo $root ?>/public/css/details.css" rel="stylesheet">

<div class='card details info' id="<?php echo 'task#' . $task->id ?>">
    <div class="closebtn" onclick="this.parentElement.classList.toggle('show')">&times;</div>
    <div class='detContent'>
        <ul>
            <li class='detTitle'> <h1 class="detLabl">Titre : </h1>       <p class="detVal"><?php echo $task->name ?></p></li>
            <li class='detDesc'>  <h1 class="detLabl">Description: </h1>  <p class="detVal"><?php echo $task->description ?></p></li>
            <li class='detDesc'>  <h1 class="detLabl">Lien: </h1>         <p class="detVal"><a target='_blank' href="<?php echo $task->extLink ?>"><?php echo $task->extLink ?></a></p></li>
            <li class='detAdd'>   <h1 class="detLabl">Ajoutée le : </h1>  <p class="detVal"><?php echo $task->addDate ?></p></li>
            <li class='detMax'>   <h1 class="detLabl">Échéance: </h1>     <p class="detVal"><?php echo $task->maxDate ?></p></li>
            <li class='detDone'>  <h1 class="detLabl">Finie le : </h1>    <p class="detVal"><?php echo $task->doneDate ?></p></li>
        </ul>
    </div>
</div>
