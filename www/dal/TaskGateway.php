<?php
/**
 * class TaskGateway
 *
 * ----------------------------------------
 * License AGPL custom : commercialization is prohibited
 * https://www.gnu.org/licenses/agpl-3.0.fr.html
 * Authors : Yann Surzur & Evrard Van Espen
 * Creation : December 2017
 */

class TaskGateway
{
    private $conf;
    private $con;

    public function __construct() 
    {
        $this->conf = Config::getInstance();
        $this->con = new Connection();
    }

    /**
     * get all tasks from a specified project
     * @param idProject the project
     */
    public function searchTaskIdProject(int $idProject) 
    {
        $query = "SELECT * FROM task WHERE idProject = :idProject";
        $this->con->executeQuery(
            $query, array(
            ':idProject'=> array($idProject,PDO::PARAM_STR)
            )
        );
        $sel = $this->con->getResult();
        $tRes = array();
        foreach ($sel as $row) {
            $tRes[] = new Task($row['id'], $row['idProject'], $row['name'], $row['description'], $row['tags'], $row['priority'], $row['state'], $row['addDate'], $row['doneDate'], $row['maxDate'], $row['extLink']);
        }
        return $tRes;
    }

    /**
     * insert a tak in db
     * @param task the task to insert
     * @return void
     */
    public function add(Task $task) : void 
    {
        if (is_null($task->maxDate) OR $task->maxDate == "") {
            $maxDate = "NULL";
        }
        else {
            $task->priority = 2;
            $maxDate = date('d/m/Y', strtotime($task->maxDate));
            $maxDate = "STR_TO_DATE('$maxDate','%d/%m/%Y')";
        }

        $query = "INSERT INTO task (idProject,name,description,tags,priority,addDate,maxDate,extLink) VALUES (:idProject, :name, :description,:tags, :priority, STR_TO_DATE('$task->addDate','%d/%m/%Y'),{$maxDate}, :extLink)";
        try {
            $this->con->executeQuery(
                $query, array(
                ':idProject'   => array($task->idProject,PDO::PARAM_INT),
                ':name'        => array($task->name,PDO::PARAM_STR),
                ':description' => array($task->description,PDO::PARAM_STR),
                ':tags'        => array($task->tags,PDO::PARAM_STR),
                ':priority'    => array($task->priority,PDO::PARAM_INT),
                ':extLink'     => array($task->extLink,PDO::PARAM_STR)
                )
            );
        } catch(PDOException $e) {
            throw new Exception("Erreur lors de l'insertion en base de données.");
        }
    }

    /**
     * remove a tak from db
     * @param idTask the task to delete
     * @return void
     */
    public function removeTask(int $idTask) : void 
    {
        $query = 'DELETE FROM task WHERE id = :idTask';
        try {
            $this->con->executeQuery(
                $query, array(
                ':idTask'=> array($idTask,PDO::PARAM_INT)
                )
            );
        } catch(PDOException $e) {
            throw new Exception("Erreur lors de la suppression de la tache");
        }
    }

    /**
     * change the state of a task
     * @param idTask the id of the task
     * @return void
     */
    public function changeState($idTask) : void 
    {
        // get current state
        $query = "SELECT state FROM task WHERE id = :idTask";
        try {
            $this->con->executeQuery(
                $query, array(
                ':idTask' => array($idTask, PDO::PARAM_INT)
                )
            );
        } catch(PDOException $e) {
            throw new Exception("Erreur lors de la récupération de l'état de la tache.");
        }
        $state = $this->con->getResult();
        $state = array_shift($state)['state'];
        $state++;

        if($state == 2){
            $doneDate = date('d/m/Y', time());
            $query = "UPDATE task SET state = :state, doneDate = STR_TO_DATE('$doneDate','%d/%m/%Y') WHERE id = :idTask";
        }
        if($state == 3){
            $this->removeTask($idTask);
        }
        else {
            $query = "UPDATE task SET state = :state WHERE id = :idTask";
        }

        try {
            $this->con->executeQuery(
                $query, array(
                ':state'  => array($state, PDO::PARAM_INT),
                ':idTask' => array($idTask, PDO::PARAM_INT)
                )
            );
        } catch(PDOException $e) {
            throw new Exception("Erreur lors du changement de l'état de la tache.");
        }
    }

    /**
     * return the tasks filtered by state and project
     * @param idProject the project who contains the tasks
     * @param stateTask the state
     * @return mixed
     */
    public function stateByProject(int $idProject, int $stateTask) 
    {
        $query = 'SELECT * FROM task WHERE idProject = :idProject AND state = :stateTask';
        try {
            $this->con->executeQuery(
                $query, array(
                ':idProject' => array($idProject,PDO::PARAM_INT),
                ':stateTask' => array($stateTask,PDO::PARAM_INT)
                )
            );
            $sel = $this->con->getResult();
            $tRes = array();
            foreach ($sel as $row) {
                $tRes[] = new Task($row['id'], $row['idProject'], $row['name'], $row['description'], $row['tags'], $row['priority'], $row['state'], $row['addDate'], $row['doneDate'], $row['maxDate'], $row['extLink']);
            }
            return $tRes;
        } catch(PDOException $e) {
            throw new Exception("Erreur lors de la rérécupération des taches.");
        }
    }
}
