<?php
/**
 * class ProjectModel
 *
 * ----------------------------------------
 * License AGPL custom : commercialization is prohibited
 * https://www.gnu.org/licenses/agpl-3.0.fr.html
 * Authors : Yann Surzur & Evrard Van Espen
 * Creation : December 2017
 */

class ProjectModel
{
    private $gw; // gateway instance

    public function __construct() 
    {
        $this->gw = new ProjectGateway();
    }

    /**
     * create a project
     * @param idOwner the id of the owner (user)
     * @param titleProject the title of the project`
     * @return void
     */
    public function createProject($idOwner, $titleProject) : void 
    {
        $titleProject = Validation::validate($titleProject, 'TEXT');
        $project = new Project(0, $titleProject, $idOwner);
        $this->gw->createProject($project);
    }

    /**
     * remove a project
     * @param idProject the id of project to remove
     * @return void
     */
    public function removeProject($idProject) : void 
    {
        $this->gw->removeProject($idProject);
    }

    /**
     *  get a project(s) by owner
     * @param idOwner the id of the owner (user)
     * @return mixed
     */
    public function searchProjectIdOwner($idOwner) 
    {
        return $this->gw->searchProjectIdOwner($idOwner);
    }

    /**
     * return project who have specified id
     * @param idProject the id of the project to get
     * @return mixed
     */
    public function searchProjectId($idProject) 
    {
        return $this->gw->searchProjectId($idProject);
    }

}
