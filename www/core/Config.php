<?php

    /**
     * class Config
     *
     * ----------------------------------------
     * License AGPL custom : commercialization is prohibited
     * https://www.gnu.org/licenses/agpl-3.0.fr.html
     * Authors : Yann Surzur & Evrard Van Espen
     * Creation : December 2017
     */

class Config
{
    protected static $_instance;
    protected static $configPath = 'config/configMaster.php';
    protected $settings = [];

    public function __construct() 
    {
        $this->settings = require(self::$configPath);
    }

    /**
     * here a singleton because its useless to open a file a lot of times
     * @return instance
     */
    public function getInstance() 
    {
        if (is_null(self::$_instance))
            self::$_instance = new Config();
        return self::$_instance;
    }

    /**
     * return the value of the given key
     * @param key the key
     * @return mixed
     */
    public function get(String $key) 
    {
        return $this->settings[$key];
    }
}
