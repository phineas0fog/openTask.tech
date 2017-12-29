<?php
/**
 * class Connection
 * connect to a database and execute queries, get results or errors
 *
 * ----------------------------------------
 * License AGPL custom : commercialization is prohibited
 * https://www.gnu.org/licenses/agpl-3.0.fr.html
 * Authors : Yann Surzur & Evrard Van Espen
 * Creation : December 2017
 */

class Connection extends PDO
{
    private $stmt;

    private $base;
    private $user;
    private $pass;

    private $dsn;

    public function __construct()
    {
        $this->base = Config::getInstance()->get('db')['base'];
        $this->user = Config::getInstance()->get('db')['user'];
        $this->pass = Config::getInstance()->get('db')['pass'];

        $this->dsn = "mysql:host=localhost;dbname=" . $this->base;

        parent::__construct($this->dsn, $this->user, $this->pass);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * prepare and execute a query
     * @param query the query to prepare & execute
     * @param parameters an array with the parameters
     */
    public function executeQuery($query, array $parameters=[]) 
    {
        $this->stmt=parent::prepare($query);
        foreach($parameters as $name=>$value){
            $this->stmt->bindValue($name, $value[0], $value[1]);
        }
        return $this->stmt->execute();
    }

    /**
     * return the results of the previous executed query
     */
    public function getResult() 
    {
        return $this->stmt->fetchall();
    }

    /**
     * get the PDO error
     */
    public function errorInfo() 
    {
        return $this->stmt->errorInfo();
    }
}
