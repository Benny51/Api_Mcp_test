<?php

namespace Controller;
use Model\Users;

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
            $findedUser = $this->user->getUserById($id);
            http_response_code(200);

            echo json_encode($findedUser);
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

    public function delete($id)
    {

        print_r(
            $_SERVER['REQUEST_METHOD']);

        if($_SERVER['REQUEST_METHOD'] === 'DELETE')
        {
            http_response_code(200);
            $rows = $this->user->delete($id);

            echo json_encode($rows);
        } else {
            http_response_code(405); //code qui respond à la méthod n'est pas autorisé
            echo json_encode(["message" => "Method not allowed"]);
        }
    }

    public function create()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            http_response_code(200);
            $this->user->create();
            echo json_encode("User crée avec succès");
        } else {
            http_response_code(405); //code qui respond à la méthod n'est pas autorisé
            echo json_encode(["message" => "Method not allowed"]);
        }
    }

}