<?php

/**
 * class VisitorController
 * The controller for all users
 *
 * ----------------------------------------
 * License AGPL custom : commercialization is prohibited
 * https://www.gnu.org/licenses/agpl-3.0.fr.html
 * Authors : Yann Surzur & Evrard Van Espen
 * Creation : December 2017
 */


class VisitorController
{
    protected $userModel;
    protected $projectModel;
    protected $taskModel;

    public function __construct() 
    {
        $this->userModel    = new UserModel();
        $this->projectModel = new ProjectModel();
        $this->taskModel    = new TaskModel();
    }


    /**
     * display the view passed in arg, homeView by default
     * @param viewToCall the name of the view to display (home by default)
     * @return void
     */
    public function call($viewToCall='homeView') : void 
    {
        if($viewToCall == 'homeView') {
            $projectsPub  = $this->projectModel->searchProjectIdOwner(1);
            if(isset($_SESSION['userId']))
                $projectsPriv = $this->projectModel->searchProjectIdOwner($_SESSION['userId']);
            else
                $projectsPriv = [];
        }

        $conf = Config::getInstance();
        require(($conf->get('rep')).($conf->get('view'))[$viewToCall]);
    }

    /**
     * get the tasks of a given project and set arrays for each state
     * @param projectId the id of the project from which get the tasks
     * @return void
     */
    public function tasks($projectId) : void
    {
        $tasksTodo    = $this->taskModel->stateByProject($projectId, 0);
        $tasksDoing   = $this->taskModel->stateByProject($projectId, 1);
        $tasksDone    = $this->taskModel->stateByProject($projectId, 2);
        $project      = $this->projectModel->searchProjectId($projectId);

        $conf = Config::getInstance();
        require(($conf->get('rep')).($conf->get('view'))['tasksView']);
    }

    /**
     * try tho delete a project
     * @param pId  the id of the project to delete
     * @return void
     */
    public function removeProject($pId) : void 
    {
        try {
            $this->projectModel->removeProject($pId);
            $this->call();
        } catch(Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            $this->call('homeView');
        }
    }

    /**
     * try to create a PUBLIC project
     * @return void
     */
    public function createProject() : void 
    {
        try {
            $this->projectModel->createProject(1, $_POST['title']);
            $this->call();
        } catch(Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            $this->call('homeView');
        }
    }

    /**
     * try to create a task
     * @return void
     */
    public function createTask() : void 
    {
        $pId = $_POST['projectId'];
        try {
            $this->taskModel->createTask($_POST['projectId'], $_POST['title'], $_POST['descr'], "", $_POST['priority'], $_POST['maxDate'], $_POST['extLink']);
            header('Location: ' . Config::getInstance()->get('ROOT_URL') . "/public/project/" . $pId);
        } catch(Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    /**
     * try to remove a task
     * @param taskId the id of the task to delete
     * @return void
     */
    public function removeTask($taskId) : void 
    {
        try {
            $this->taskModel->removeTask($taskId);
        } catch(Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    /**
     * try to change the state of a task
     * @param id the id of the task
     * @return void
     */
    public function changeState($id) : void 
    {
        try {
            $this->taskModel->changeState($id);
        } catch(Excepion $e) {
            $_SESSION['Error'] = $e->getMessage();
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    /**
     * call the method to display 'about' page
     * @return void
     */
    public function about() : void 
    {
        $this->call('about');
    }
}
