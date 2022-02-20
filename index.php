
<?php

//Point d'entrée de l'application, c'est ici que les routes seront créées

use Router\Router;
use Router\RouterException;

require_once ('Model/Response.php');
require_once ('Model/Model.php');
require_once ('Controller/UsersController.php');
require_once ('Infrastructure/Config/Database.php');
require_once ('Router/Router.php');
require_once ('Model/Users.php');

//$router = new Router($_GET['url']);

//print_r($_GET['url']);

//Avec une fonction anonyme
/*$router->get('/tiers/:id', function($id){
    $user = new Users();
    var_dump($user->getUserById($id));
});*/

//Url plus complex
/*
$router->get('/JS',function (){
    header('Location:index.html');
});

$router->get('/getSlug/:slug-:id',function ($slug,$id){
   echo "Tiers --> $slug --> $id";
})->with('id','[0-9]+')->with('slug','[a-z\-0-9]+');
//Ici quand l'url cherchera les paramètres pour l'id il ne pourra prendre que des chiffres et pour le slug il pourra tout prendre

//Avec route nommée

$router->get('/namedRoute/:id-:slug',function ($id,$slug) use($router){
    echo $router->url('name',['id'=>$id,'slug'=>$slug]);
},'name')->with('id','[0-9]+')->with('slug','[a-z\-0-9]+');
*/
//Avec le controller
//$router->get('/getAllTiers',"Users#getAllUsers");
/*$router->get('/tiers/:id', "Users#getUserById");

$router->post('/create',"Users#create");*/

/*
try {
    $router->get('/getSlug/:id-:slug', function ($id, $slug) {
        echo "Tiers --> $slug --> $id";
    })->with('id', '[0-9]+')->with('slug', '[a-z\-0-9]+')->run();
} catch (RouterException $e) {}*/


$router = new Router($_GET['url']);

$router->get('/tiers',"Users#getAllUsers");

$router->get('/tiers/:id', "Users#getUserById")->with('id', '[0-9]+');

$router->post('/tiers/create', "Users#create");

$router->delete('/tiers/delete/:id', "Users#delete")->with('id', '[0-9]+');

try {
    $router->run();
} catch (RouterException $e) {
}




