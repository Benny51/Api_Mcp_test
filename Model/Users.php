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

        $sqlQuery = "INSERT INTO $this->table_name (username,password,age,email) values(:username,:password,:age,:email)";
        $pdoStatement = $this->db->getBddConnect()->prepare($sqlQuery);
        $passwordHash = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $pdoStatement->bindParam(':username',$_POST['username']);
        $pdoStatement->bindParam(':password',$passwordHash);
        $pdoStatement->bindParam(':age',$_POST['age']);
        $pdoStatement->bindParam(':email',$_POST['email']);
        //Stocker dans une variable le dernier insert
        $_POST['id'] = $this->db->getBddConnect()->lastInsertId();


        return $pdoStatement;
    }

    function getAll()
    {
        $sqlQuery = "SELECT * FROM $this->table_name";
        $pdoStatement = $this->db->getBddConnect()->query($sqlQuery);
        return $pdoStatement;
    }

    function getUserById($id)
    {
        $sqlQuery = "SELECT * FROM $this->table_name where $this->colPrimaryKey = :id";
        $pdoStatement = $this->db->getBddConnect()->prepare($sqlQuery);
        //$pdoStatement->bindParam(":id",$id);
        /*$pdoStatement->execute(array(
           'id'=>$id
        ));*/
        //return $pdoStatement->fetch(\PDO::FETCH_ASSOC);
        $pdoStatement->bindParam(":id",$id);
        $pdoStatement->execute();
        return $pdoStatement;
    }

    function update($id)
    {
        $sqlQuery = "UPDATE $this->table_name set username = :username, set password = :password  ,set age = :age,set email = :email) where id = :id";
        $pdoStatement = $this->db->getBddConnect()->prepare($sqlQuery);

        $pdoStatement->bindParam(':id',$id);
        $passwordHash = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $pdoStatement->bindParam(':username',$_POST['username']);
        $pdoStatement->bindParam(':password',$passwordHash);
        $pdoStatement->bindParam(':age',$_POST['age']);
        $pdoStatement->bindParam(':email',$_POST['email']);
        return $pdoStatement->execute();

}

    function delete($id)
    {
        $sqlquery = "DELETE FROM $this->table_name where $this->colPrimaryKey = :id";
        $pdoStatement = $this->db->getBddConnect()->prepare($sqlquery);
        $pdoStatement->bindParam(':id',$id);

        return $pdoStatement;

    }
}