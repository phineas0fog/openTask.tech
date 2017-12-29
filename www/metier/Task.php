<?php
/**
 * class Task
 * define what a task is
 *
 * ----------------------------------------
 * License AGPL custom : commercialization is prohibited
 * https://www.gnu.org/licenses/agpl-3.0.fr.html
 * Authors : Yann Surzur & Evrard Van Espen
 * Creation : December 2017
 */

    class Task
    {
        private    $id;
        private $idProject;
        private $name;
        private $description;
        private $tags;
        private $priority;
        private $state;
        private $addDate;
        private $doneDate;
        private $maxDate;
        private $extLink;

        public function __construct($id, $idProject, $name, $description, $tags, $priority, $state, $addDate, $doneDate, $maxDate, $extLink)
        {
            $this->id          = $id;
            $this->idProject   = $idProject;
            $this->name        = $name;
            $this->description = $description;
            $this->tags        = $tags;
            $this->priority    = $priority;
            $this->state       = $state;
            $this->addDate     = $addDate;
            $this->doneDate    = $doneDate;
            $this->maxDate     = $maxDate;
            $this->extLink     = $extLink;
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
