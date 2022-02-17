<?php

namespace Model;
use Infrastructure;

class Users implements Model
{

    private $table_name = "users";

    //Column name of the db
    private $colPrimaryKey = "id";
    private $colUsername = "username";
    private $colPassword = "password";
    private $colAge = "age";
    private $colEmail = "email";

    private $db;

    public function __construct()
    {
        $this->db = new Infrastructure\Database();
    }


    function create()
    {
        // TODO: Implement create() method.
    }

    function getAll()
    {
        $sqlQuery = "SELECT * FROM $this->table_name";
        $pdoStatement = $this->db->getBddConnect()->query($sqlQuery);
        return $pdoStatement->fetchAll(\PDO::FETCH_ASSOC);
    }

    function getUserById($id)
    {
        $sqlQuery = "SELECT * FROM $this->table_name where $this->colPrimaryKey = :id";
        $pdoStatement = $this->db->getBddConnect()->prepare($sqlQuery);
        $pdoStatement->execute(array(
           'id'=>$id
        ));
        return $pdoStatement->fetch(\PDO::FETCH_ASSOC);
    }

    function update()
    {
        // TODO: Implement update() method.
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
    }
}