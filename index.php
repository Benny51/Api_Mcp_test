<?php

//Point d'entrée de l'application, c'est ici que les routes seront créées

//Routes here

use Router\Router;
use Model\Users;
use Router\RouterException;

require_once ('Model/Model.php');
require_once ('Infrastructure/Config/Database.php');
require_once ('Router/Router.php');
require_once ('Model/Users.php');
$router = new Router($_GET['url']);

/*f
$router->get('/',function (){
    echo 'Oui';
});*/
/*
$router->get('/tiers/:id-:slug',function () {

})->with('id','[0-9]+')->with('slug', "['a-z\-0-9']+");*/

//AVEC LE CONTROLER

$router->map('/tiers/:id',"Users#getById","tiers.show",'GET');

/*
$router->get('/tiers/:id',function ($id){
    echo "Le tiers avec l'id $id";
});*/

try {
    $router->run();
} catch (RouterException $e) {
    echo $e->getMessage();
}

