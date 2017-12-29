<?php
    /**
     * Config aggregator
     * Used because the database config file is ignored by git
     *
     * You can add config file by just add his path with include
     * and add var name to end of "array_merge" args
     */
    $confG = include 'configGeneral.php';
    $confD = include 'configDyn.php';

    $confM = array_merge($confG, $confD);

    return $confM;
