<?php

namespace Controller;
use Model\Response;
use Model\Users;
use PDO;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); //réponse en JSON
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600"); // durée de vie de la requette
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

class UsersController
{
    /***
     * @var Users $user
     */
    private $user;

    public function __construct()
    {
        $this->user = new Users();
    }

    public function getUserById($id)
    {
        if($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            $pdoStatement = $this->user->getUserById($id);
            $response = new Response();
            if($pdoStatement->rowCount() === 0)
            {
                $response->setHttpStatusCode(404);
                $response->setSuccess(false);
                $response->addMessage("Tiers not found");
                $response->send();
                exit;
            }

            $findUser = $pdoStatement->fetch(PDO::FETCH_ASSOC);

            $response->setHttpStatusCode(200);
            $response->setSuccess(true);
            $response->addMessage("find");
            $response->toCache(true);
            $response->setData($findUser);
            $response->send();
            exit;

        } else {
            http_response_code(405); //code qui respond à la méthod n'est pas autorisé
            echo json_encode(["message" => "Method not allowed"]);
        }
    }

    public function getAllUsers()
    {
        if($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            $users = $this->user->getAll();
            $response = new Response();
            if($users->rowCount() === 0)
            {
                $response->setHttpStatusCode(404);
                $response->setSuccess(false);
                $response->addMessage("Aucun user dans la db");
                $response->send();
                exit;
            }

            $response->setHttpStatusCode(200);
            $response->setSuccess(true);
            $response->toCache(true);
            $response->setData($users->fetchAll(PDO::FETCH_ASSOC));
            $response->send();
            exit;

        } else {
            http_response_code(405); //code qui respond à la méthod n'est pas autorisé
            echo json_encode(["message" => "Method not allowed"]);
        }
    }

    public function update()
    {
        if($_SERVER['REQUEST_METHOD'] === 'PUT')
        {

        }
    }

    public function delete($id)
    {
        if($_SERVER['REQUEST_METHOD'] === 'DELETE')
        {

            $deletequery = $this->user->delete($id);
            $idUserquery = $this->user->getUserById($id);
            $response = new Response();

            if($idUserquery->rowCount()===0)
            {
                $response->setHttpStatusCode(404);
                $response->setSuccess(false);
                $response->addMessage("L'id tiers n'existe pas");
                $response->send();
                exit;
            }
            $deletequery->execute();
            $response->setHttpStatusCode(200);
            $response->setSuccess(true);
            $response->addMessage("Delete");
            $response->toCache(true);
            $response->send();

        } else {
            http_response_code(405); //code qui respond à la méthod n'est pas autorisé
            echo json_encode(["message" => "Method not allowed"]);
        }
    }

    public function create()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            if (isset($_POST['submit']))
            {
                $pdostatement = $this->user->create();

                $idUserquery = $this->user->getUserById($_POST['id']);
                $response = new Response();
                //cela veut dire qu'il existe
                if($idUserquery->rowCount() === 1)
                {
                    $response->setHttpStatusCode(409);
                    $response->setSuccess(false);
                    $response->addMessage("Conflicts doublon");
                    $response->send();
                    exit;
                }

                $pdostatement->execute();
                $response->setHttpStatusCode(200);
                $response->setSuccess(true);
                $response->addMessage("Ajout Succès");
                $response->toCache(true);
                $response->send();
                exit;
            }

        } else {
            http_response_code(405); //code qui respond à la méthod n'est pas autorisé
            echo json_encode(["message" => "Method not allowed"]);
        }
    }

}