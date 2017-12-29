<?php
/**
 * class UserGateway
 *
 * ----------------------------------------
 * License AGPL custom : commercialization is prohibited
 * https://www.gnu.org/licenses/agpl-3.0.fr.html
 * Authors : Yann Surzur & Evrard Van Espen
 * Creation : December 2017
 */


class UserGateway
{
    private $conf;
    private $con;

    public function __construct() 
    {
        $this->conf = Config::getInstance();
        $this->con = new Connection();
    }

    /**
     * insert an user in db
     * @param user the usr to insert
     * @return void
     */
    public function addUser(User $user) : void 
    {
        $query = 'INSERT INTO user (name,password, mail) VALUES (:nameUser, :passwordUser, :mail)';
        try {
            $this->con->executeQuery(
                $query, array(
                ':nameUser'     => array($user->name,PDO::PARAM_STR),
                ':passwordUser' => array($user->password,PDO::PARAM_STR),
                ':mail'         => array($user->mail,PDO::PARAM_STR)
                )
            );
        } catch(PDOException $e) {
            switch($this->con->errorInfo()[1]) {
                case 1062:
                    throw new Exception("Ce pseudonyme est déjà utilisé.");
                default:
                    throw new Exception("Erreur lors de l'ajout en base de données.");
            }
        }
    }

    /**
     * get a specific user from db
     * @param username the name of the user
     * @param pass the hash of the pass of the user
     */
    public function verifyUserData(String $username, String $pass) 
    {
        $query = 'SELECT * FROM user WHERE name = :username AND password = :pass';
        try {
            $this->con->executeQuery(
                $query, array(
                ':username'=> array($username,PDO::PARAM_STR),
                ':pass'=> array($pass,PDO::PARAM_STR)
                )
            );
            $sel = $this->con->getResult();
            $Tres = array();
            foreach ($sel as $row) {
                $Tres[] = new User($row['id'], $row['name'], $row['password'], $row['mail']);
            }
            return $Tres;
        } catch (PDOException $e) {
                    throw new Exception("Erreur lors de la lecture en base de données.");
        }
    }

    /**
     * get the password hash from database
     * @param  username the user from who get the data
     */
    public function getData(String $username) 
    {
        $query = 'SELECT * FROM user WHERE name = :username';
        try {
            $this->con->executeQuery(
                $query, array(
                ':username'=> array($username,PDO::PARAM_STR)
                )
            );
            $sel = $this->con->getResult();
            $Tres = array();
            foreach ($sel as $row) {
                $Tres[] = new User($row['id'], $row['name'], $row['password'], $row['mail']);
            }
            return $Tres[0];
        } catch (PDOException $e) {
                    throw new Exception("Erreur lors de la lecture en base de données.");
        }
    }
}
