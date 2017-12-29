<?php
    //chargement autoloader pour autochargement des classes
    require_once(__DIR__.'/config/Autoload.php');
    Autoload::charger();

    if(empty($_SESSION))
        session_start();

    $router = Router::getInstance();
    $router->init();
