<?php

namespace Infrastructure;

use PDO;

class Database
{
    private $host = 'localhost';
    //private $db_name = "apidatabase";

    private $db_name = "0_fid_basecentrale";

    private$username = "root";
    //private$password = "";
    private$password = "Suveva70";

    private $bdd_connect = null;
    //Creation of the database
    public function __construct()
    {
        try {
            $this->bdd_connect = new \PDO("mysql:host=$this->host;dbname=$this->db_name",$this->username,$this->password,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        }catch (\PDOException $exception)
        {
            echo 'Connexion failed -> ' .$exception->getMessage();
        }
    }

    /**
     * @return \PDO|null
     */
    public function getBddConnect()
    {
        return $this->bdd_connect;
    }

}