<?php

namespace Controller;

use Model\Response;
use Model\Tiers;
use PDO;

header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8"); //réponse en JSON
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600"); // durée de vie de la requette
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

class TiersController
{
    /***
     * @var Tiers $tier
     */
    private $tier;
    /***
     * @var Response $response
     */
    private $response;

    public function __construct()
    {
        $this->tier = new Tiers();
        $this->response = new Response();
    }

    public function getAllTiers()
    {
        if($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            $pdoStatement = $this->tier->getAll();

            if($pdoStatement->rowCount() === 0)
            {
                $this->response->setHttpStatusCode(404);
                $this->response->setSuccess(false);
                $this->response->addMessage("Aucun tiers dans la db");
                $this->response->send();
                exit;
            }

            $this->response->setHttpStatusCode(200);
            $this->response->setSuccess(true);
            $this->response->setData($pdoStatement->fetchAll(PDO::FETCH_ASSOC));
            $this->response->send();
            exit;

        } else {
            $this->notAllowed();
        }
    }

    public function getTierById($id)
    {
        if($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            $pdoStatement = $this->tier->getTierById($id);

            if($pdoStatement->rowCount() === 0)
            {
                $this->response->setHttpStatusCode(404);
                $this->response->setSuccess(false);
                $this->response->addMessage("Tiers not found");
                $this->response->send();
                exit;
            }

            $findTier = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

            $this->response->setHttpStatusCode(200);
            $this->response->setSuccess(true);
            $this->response->addMessage("find");
            $this->response->toCache(true);
            $this->response->setData($findTier);
            $this->response->send();
            exit;

        } else {
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