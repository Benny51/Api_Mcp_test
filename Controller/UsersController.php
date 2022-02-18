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

            if($pdoStatement->rowCount() === 0)
            {
                $response = new Response();
                $response->setHttpStatusCode(404);
                $response->setSuccess(false);
                $response->addMessage("Tiers not found");
                $response->send();
                exit;
            }

            $findUser = $pdoStatement->fetch(PDO::FETCH_ASSOC);
            $response = new Response();
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
            http_response_code(200);
            echo json_encode($this->user->getAll());
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
            http_response_code(200);
            $delete = $this->user->delete($id);
            $delete->execute();

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
                $this->user->create();
            }

        } else {
            http_response_code(405); //code qui respond à la méthod n'est pas autorisé
            echo json_encode(["message" => "Method not allowed"]);
        }
    }

}