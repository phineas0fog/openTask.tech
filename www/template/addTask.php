<link href="<?php echo $root ?>/public/css/add.css" rel="stylesheet">
<link href="<?php echo $root ?>/public/css/form.css" rel="stylesheet">

<div class='addTask card'>
    <form method='post' action='<?php echo $root ?>/task/add' class='form'>
        <ul>
            <input type="hidden" name="projectId" value="<?php echo $projectId ?>"
            <li><input type="text" placeholder="Titre" name="title" required/></li>
            <li><textarea cols="100" rows="2" placeholder="Description" name="descr" res></textarea></li>
            <!-- <li><p>Project</p><select name="project">
                <?php foreach ($projects as $project): ?>
                    <option value=<?php echo $project->id ?>><?php echo $project->title ?></option>
                <?php endforeach; ?>
                <option value="" selected>None</option>
            </select></li> -->


            <li><p>Priorité</p><select name="priority">
                <option value="0">basse</option>
                <option value="1" selected>normale</option>
                <option value="2">importante</option>
                <option value="3">CRITIQUE</option>
            </select></li>


            <li><p>Échéance</p><input type="date" name="maxDate" placeholder="Échéance" min="<?php echo date('Y-m-d', time()) ?>"/></li>
            <li><input type="text" name="extLink" placeholder="Lien externe (doit commencer par 'http://')"/></li>
            <li><input type="submit" value="Ajouter tâche" style="margin-top: 2vh;"/></li>
        </ul>

    </form>
</div>
