<?php $root = Config::getInstance()->get('ROOT_URL') ?>

<meta charset="utf-8">
<title>Open-Task - The magic task manager</title>
<link rel="icon" type="image/png" href="<?php echo $root ?>/public/img/logo.png" />

<!-- css links -->
<?php if (Config::getInstance()->get('deploy') == 'dev'): ?>
    <link href="<?php echo $root ?>/public/css/reset.css" rel="stylesheet">

    <!-- SNOW -->
    <link media='screen and (min-width: 1920px)' href="<?php echo $root ?>/public/css/snow.css" rel="stylesheet">
    <!-- /SNOW -->

    <link href="<?php echo $root ?>/public/css/common.css" rel="stylesheet">
    <link href="<?php echo $root ?>/public/css/breadCrumb.css" rel="stylesheet">
    <link href="<?php echo $root ?>/public/css/buttons.css" rel="stylesheet">
    <link href="<?php echo $root ?>/public/css/header.css" rel="stylesheet">

    <link href="<?php echo $root ?>/public/css/fontConfig.css" rel="stylesheet">
<?php elseif (Config::getInstance()->get('deploy') == 'prod'): ?>
    <link href="<?php echo $root ?>/public/min/min.css" rel="stylesheet">
<?php endif ?>

<!-- js links -->
<?php
    echo '<script type="text/javascript">';
        if (Config::getInstance()->get('deploy') == 'dev') {
            include 'public/js/menu.js';
            include 'public/js/notif.js';
            include 'public/js/register.js';
        } elseif (Config::getInstance()->get('deploy') == 'prod') {
            include 'public/min/min.js';
        }
    echo '</script>';
