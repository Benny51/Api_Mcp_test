<?php

//Point d'entrée de l'application, c'est ici que les routes seront créées

use Router\Router;
use Router\RouterException;

require_once ('Model/Model.php');
require_once ('Infrastructure/Config/Database.php');
require_once ('Router/Router.php');
require_once ('Model/Users.php');

$router = new Router($_GET['url']);

$router->get('/', function(){ echo "Homepage !"; });
$router->get('/tiers/:id', function($id){ echo "Tiers ! : $id"; });

try {
    $router->run();
} catch (RouterException $e) {
    echo $e->getMessage();
}