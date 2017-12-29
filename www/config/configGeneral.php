<?php
    /**
     * General config file
     *
     * ['view']['name'] -> location for each view
     */
    $conf['rep'] = __DIR__.'/../';

    $conf['view']['configPrive'] = 'view/configPrive.php';
    $conf['view']['signIn']      = 'view/signIn.php';
    $conf['view']['tasksView']   = 'view/tasksView.php';
    $conf['view']['homeView']    = 'view/homeView.php';
    $conf['view']['login']       = 'view/loginView.php';
    $conf['view']['register']    = 'view/registerView.php';
    $conf['view']['about']       = 'view/about.php';
    $conf['view']['error']       = 'view/error.php';
    $conf['view']['error404']    = 'view/error404.php';

    return $conf;
