<?php
/**
 * class UserModel
 *
 * ----------------------------------------
 * License AGPL custom : commercialization is prohibited
 * https://www.gnu.org/licenses/agpl-3.0.fr.html
 * Authors : Yann Surzur & Evrard Van Espen
 * Creation : December 2017
 */

class UserModel
{
    private $gw;
    private $salt;

    public function __construct() 
    {
        $this->gw = new UserGateway();
        $this->salt = 'M2E1MGFhYzk1MTdlMjU3YWZjNzFlNzQ3M2E1MGFhYzk1MTdlMjU3YWZjNzFlNzQ3';
    }

    /**
     * check the login
     * @return boolean
     */
    public function checkLogin() 
    {
        $username = $_POST['name'];
        $pass     = $_POST['password'];

        $user = $this->gw->getData($username);
        $trueHash = $user->password;

        try {
            if(password_verify($pass, $trueHash)) {
                $_SESSION['userId'] = $user->id;
                $_SESSION['name']   = $user->name;
                $_SESSION['role']   = 'user';

                return true;
            }
            else {
                throw new Exception("Identifiant ou mot de passe incorrect(s)...");
            }
        }
        catch (PDOException $e) {
            throw new Exception("Problème lors de la vérification en base de données.");
        }
    }

    /**
     * check/clean the data given by user
     * check if mail is a mail
     * check if the 2 passwords corresponds
     * and call the method to insert user in db
     * @return boolean
     */
    public function registerHandl() 
    {
        $username  = Validation::validate($_POST['username'], 'TEXT');
        $mail      = $_POST['mail'];

        if(!Validation::validate($mail, 'MAIL'))
            throw new Exception("L'email n'est pas valide.");

        $pass      = $_POST['pass'];
        $passVerif = $_POST['passVerif'];

        if($pass != $passVerif)
            throw new Exception("Les mots de passe ne correspondent pas.");

        if(!Validation::validate($pass, 'PASS'))
            throw new Exception("Le mot de passe choisi ne respecte pas les conditions");

        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $user = new User(0, $username, $hash, $mail);

        $this->gw->addUser($user);
        return true;
    }
}
