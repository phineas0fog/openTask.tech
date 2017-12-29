<?php
/**
 * class Project
 * define what a project is
 *
 * ----------------------------------------
 * License AGPL custom : commercialization is prohibited
 * https://www.gnu.org/licenses/agpl-3.0.fr.html
 * Authors : Yann Surzur & Evrard Van Espen
 * Creation : December 2017
 */

    class Project
    {
        private $id;
        private $title;
        private $idOwner;

        public function __construct($id, $title, $idOwner)
        {
            $this->id      = $id;
            $this->title   = $title;
            $this->idOwner = $idOwner;
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
