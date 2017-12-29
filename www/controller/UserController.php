<?php

/**
 * class UserController
 * The controller for connected user
 *
 * ----------------------------------------
 * License AGPL custom : commercialization is prohibited
 * https://www.gnu.org/licenses/agpl-3.0.fr.html
 * Authors : Yann Surzur & Evrard Van Espen
 * Creation : December 2017
 */

class UserController extends VisitorController
{

    /**
     * try to create a PRIVATE project
     * @return void
     */
    public function createProject() : void 
    {
        try {
            $this->projectModel->createProject($_SESSION['userId'], $_POST['title']);
            $this->call();
        } catch(Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            $this->call('homeView');
        }
    }

    /**
     * call the login view
     * @return void
     */
    public function login() : void 
    {
        $this->call('login');
    }

    /**
     * call the checkLogin method
     * @return void
     */
    public function checkLogin() : void 
    {
        try {
            if($this->userModel->checkLogin())
                header('Location: ' . Config::getInstance()->get('ROOT_URL'));
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            $this->call('login');
        }
    }

    /**
     * call the register view
     * @return void
     */
    public function register() : void 
    {
        $this->call('register');
    }

    /**
     * handle the registeration
     * @return void
     */
    public function registerHandl() : void
    {
        try {
        if($this->userModel->registerHandl())
                $this->call();
        } catch(Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            $this->call('register');
        }
    }

    /**
     * unset the session and call home view
     * @return void
     */
    public function logout() : void
    {
        session_unset();
        $this->call();
    }
}
