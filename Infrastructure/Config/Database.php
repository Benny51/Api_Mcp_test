<?php

namespace Infrastructure;

class Database
{
    private $host = 'localhost';
    private$db_name = "apidatabase";
    private$username = "root";
    private$password = "Suveva70";

    private $bdd_connect = null;
    //Creation of the database
    public function __construct()
    {
        try {
            $this->bdd_connect = new \PDO("mysql:host=$this->host;dbname=$this->db_name",$this->username,$this->password);
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