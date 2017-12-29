<?php
/**
 * class ProjectGateway
 * this class make the link between utils and database
 *
 * ----------------------------------------
 * License AGPL custom : commercialization is prohibited
 * https://www.gnu.org/licenses/agpl-3.0.fr.html
 * Authors : Yann Surzur & Evrard Van Espen
 * Creation : December 2017
 */

class ProjectGateway
{
    private $conf;
    private $con;

    public function __construct() 
    {
        $this->conf = Config::getInstance();
        $this->con = new Connection();
    }

    /**
     * search project by id
     * @param idProject th id to search
     */
    public function searchProjectId(int $idProject) 
    {
        $query = 'SELECT * FROM project WHERE id = :idProject';
        $this->con->executeQuery(
            $query, array(
            ':idProject'=> array($idProject,PDO::PARAM_INT)
            )
        );
        $sel = $this->con->getResult();
        $tRes = array();
        foreach($sel as $row)
            $tRes[] = new Project($row['id'], $row['title'], $row['idOwner']);
        return $tRes;
    }

    /**
     * search project by owner
     * @param idOwner the id of owner
     */
    public function searchProjectIdOwner(int $idOwner) 
    {
        $query = 'SELECT * FROM project WHERE idOwner = :idOwner';
        $this->con->executeQuery(
            $query, array(
            ':idOwner'=> array($idOwner,PDO::PARAM_STR)
            )
        );
        $sel = $this->con->getResult();
        $tRes = array();
        foreach($sel as $row)
            $tRes[] = new Project($row['id'], $row['title'], $row['idOwner']);
        return $tRes;
    }

    /**
    * insert a project in db
     * @param project the project to insert in db
     * @return void
     */
    public function createProject(Project $project) : void 
    {
        $query = 'INSERT INTO project (title,idOwner) VALUES (:titleProject,:idOwner)';
        try {
            $this->con->executeQuery(
                $query, array(
                ':titleProject' => array($project->title,PDO::PARAM_STR),
                ':idOwner'      => array($project->idOwner,PDO::PARAM_INT)
                )
            );
        } catch(PDOException $e) {
            switch($this->con->errorInfo()[1]) {
                case 1452:
                    throw new Exception("Le projet doit être lié à un utilisateur.");
                default:
                    throw new Exception("Erreur lors de l'ajout du projet.");
            }
        }
    }

    /**
     * remove a project form db
     * @param idProject the id of the project to remove
     * @return void
     */
    public function removeProject(int $idProject) : void 
    {
        $query = 'DELETE FROM project WHERE id = :idProject';
        try {
            $this->con->executeQuery(
                $query, array(
                ':idProject'=> array($idProject,PDO::PARAM_INT)
                )
            );
        } catch(PDOException $e) {
            switch($this->con->errorInfo()[1]) {
                case 1451:
                    throw new Exception("Le projet contient toujours des tâches.");
                default:
                    throw new Exception("Erreur lors de le suppression du projet.");
            }
        }
    }
}
