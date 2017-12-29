

<link href="<?php echo $root?>/public/css/add.css" rel="stylesheet">
<link href="<?php echo $root?>/public/css/form.css" rel="stylesheet">
<link href="<?php echo $root?>/public/css/buttons.css" rel="stylesheet">

<div class='add form card btn-submit rows2'>
    <form method='post' action='<?php echo $root ?>/public/project/add'>
        <ul>
            <li><input type="text" placeholder="Titre" name="title" required/></li>
            <li><input type="submit" value="Ajouter projet" style="height: 5vh" /></li>
        </ul>

    </form>
</div>
