<?php
/**
 * class TaskModel
 *
 * ----------------------------------------
 * License AGPL custom : commercialization is prohibited
 * https://www.gnu.org/licenses/agpl-3.0.fr.html
 * Authors : Yann Surzur & Evrard Van Espen
 * Creation : December 2017
 */

class TaskModel
{
    private $gw; // gateway instance

    public function __construct() 
    {
        $this->gw = new TaskGateway();
    }

    /**
     * call the state changement method
     * @param idTask the id of the task
     * @return void
     */
    public function changeState($idTask) : void 
    {
        $this->gw->changeState($idTask);
    }

    /**
     * call the method to get tasks by project id and state
     * @param projectId the id of project to get from
     * @param state the state of the tasks to get
     * @return array
     */
    public function stateByProject($projectId, $state) : array 
    {
        return $this->gw->stateByProject($projectId, $state);
    }

    /**
     * check/clean the data given by the user
     * and create a task (the object) and call method
     * to insert it in db
     * @param * the params to create task
     * @return void
     */
    public function createTask($idProject, $name, $description, $tags, $priority, $maxDate, $extLink) : void 
    {
        $addDate = date('d/m/Y', time());

        $name        = Validation::validate($name, 'TEXT');
        $tags        = Validation::validate($tags, 'TEXT');
        $description = Validation::validate($description, 'TEXT');

        if($maxDate != "" AND !Validation::validate($maxDate, 'DATE'))
            throw new Exception("La date n'est pas valide");

        if($extLink != "" AND !Validation::validate($extLink, 'URL'))
            throw new Exception("Le lien saisi est invalide.");

        $task = new Task(0, $idProject, $name, $description, $tags, $priority, 0, $addDate, NULL, $maxDate, $extLink);

        $this->gw->add($task);
    }

    /**
     * call the method to remove task from db
     * @param idTask the id of the task to delete
     * @return void
     */
    public function removeTask($idTask) : void 
    {
        $this->gw->removeTask($idTask);
    }
}
