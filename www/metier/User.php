<?php
/**
 * class User
 * define what a user is
 *
 * ----------------------------------------
 * License AGPL custom : commercialization is prohibited
 * https://www.gnu.org/licenses/agpl-3.0.fr.html
 * Authors : Yann Surzur & Evrard Van Espen
 * Creation : December 2017
 */

    class User
    {
        private $id;
        private $name;
        private $password;
        private $mail;

        public function __construct($id, $name, $password, $mail)
        {
            $this->id       = $id;
            $this->name     = $name;
            $this->password = $password;
            $this->mail     = $mail;
        }

        public function __get($key)
        {
            if(property_exists($this, $key)){
                return $this->$key;
            }
            else{
                return NULL;
            }
        }

        public function __set($key,$value)
        {
            if(property_exists($this, $key)){
                $this->$key = $value;
            }
            else{
                return false;
            }
            return true;
        }
    }
