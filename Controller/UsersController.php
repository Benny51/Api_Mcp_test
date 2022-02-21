<?php

namespace Controller;
use Model\Response;
use Model\Users;
use PDO;

header('Access-Control-Allow-Origin: *');
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
    private $response;

    public function __construct()
    {
        $this->user = new Users();
        $this->response = new Response();
    }

    public function getUserById($id)
    {
        if($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            $pdoStatement = $this->user->getUserById($id);

            if($pdoStatement->rowCount() === 0)
            {
                $this->response->setHttpStatusCode(404);
                $this->response->setSuccess(false);
                $this->response->addMessage("Tiers not found");
                $this->response->send();
                exit;
            }

            $findUser = $pdoStatement->fetch(PDO::FETCH_ASSOC);

            $this->response->setHttpStatusCode(200);
            $this->response->setSuccess(true);
            $this->response->addMessage("find");
            $this->response->toCache(true);
            $this->response->setData($findUser);
            $this->response->send();
            exit;

        } else {
            $this->notAllowed();
        }
    }

    public function getAllUsers()
    {
        if($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            $users = $this->user->getAll();

            if($users->rowCount() === 0)
            {
                $this->response->setHttpStatusCode(404);
                $this->response->setSuccess(false);
                $this->response->addMessage("Aucun user dans la db veuillez en rajouter");
                $this->response->send();
                exit;
            }

            $this->response->setHttpStatusCode(200);
            $this->response->setSuccess(true);
            $this->response->toCache(true);
            $this->response->setData($users->fetchAll(PDO::FETCH_ASSOC));
            $this->response->send();
            exit;

        } else {
            $this->notAllowed();
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

            if($idUserquery->rowCount()===0)
            {
                $this->response->setHttpStatusCode(404);
                $this->response->setSuccess(false);
                $this->response->addMessage("L'id tiers n'existe pas");
                $this->response->send();
                exit;
            }
            $deletequery->execute();
            $this->response->setHttpStatusCode(200);
            $this->response->setSuccess(true);
            $this->response->addMessage("Delete");
            $this->response->toCache(true);
            $this->response->send();

        } else {
            $this->notAllowed();
        }
    }

    public function create()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {

            //Il faut vérifier avant de pouvoir execute que tous les champs sois remplis
            /*if(!isset($_POST['submit']))
            {
                $this->response->setHttpStatusCode(422);
                $this->response->setSuccess(false);
                $this->response->addMessage("Veuillez Soumettre votre formulaire");
                $this->response->send();
                exit;
            }*/



                //Vérification que le formulaire aie bien été posté
            if (isset($_POST['submit']))
            {
                $pdostatement = $this->user->create();
                //Vérification des doublons --> pas bon faut corriger
                /*$idUserquery = $this->user->getUserById($_POST['id']);

                //cela veut dire qu'il existe
                if($idUserquery->rowCount() === 1)
                {
                    $this->response->setHttpStatusCode(409);
                    $this->response->setSuccess(false);
                    $this->response->addMessage("Conflicts doublon");
                    $this->response->send();
                    exit;
                }*/

                if(empty($_POST['email']) && empty($_POST['username']) && empty($_POST['age']) && empty($_POST['password']))
                {
                    $this->response->setHttpStatusCode(400);
                    $this->response->setSuccess(false);
                    $this->response->addMessage("Veuillez remplir tous les champs");
                    $this->response->send();
                    exit;
                }

                //S'il n'y a pas de doublons on peut executer la création

                $this->response->setHttpStatusCode(200);
                $this->response->setSuccess(true);
                $this->response->addMessage("Ajout Succès");
                $this->response->toCache(true);
                $this->response->setData($pdostatement->execute());
                $this->response->send();
                exit;
            }

        } else {
            //Cela ne correspond pas à la bon méthode pour la création
            $this->notAllowed();
        }
    }


    public function notAllowed()
    {
        $this->response->setHttpStatusCode(405);
        $this->response->setSuccess(false);
        $this->response->addMessage("Method not allowed");
        $this->response->send();
        exit;
    }

}