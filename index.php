<?php

//Routes here
use Router\Router;
use Model\Users;
require_once ('Model/Model.php');
require_once ('Infrastructure/Config/Database.php');
require_once ('Router/Router.php');
require_once ('Model/Users.php');
$router = new Router($_GET['url']);

$router->get('/tiers',function (){

    $user= new Users();
    ?> <pre><?php  var_dump($user->getAll()); ?></pre> <?php
});

$router->get('/tiers/:id',function ($id){
    $user= new Users();
    ?> <pre><?php  var_dump($user->getById($id)); ?></pre> <?php

});

$router->run();

