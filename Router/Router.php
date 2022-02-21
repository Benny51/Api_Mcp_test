<?php
namespace Router;
require_once ('Route.php');
require_once ('RouterException.php');
class Router
{
    /***
     * Contiendra l'URL sur laquelle on souhaite se rendre
     * @var string $url;
     */
    private $url;
    /***
     * Variable qui stock toutes les routes enregistrées par l'utilisateur (GET,POST,DELETE,PUT)
     * @var Route []
     */
    private $routes = [];

    /***
     * @param string $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /***
     * @param $path : Chemin de la route
     * @param $callable : Fonction appelée en fonction de la route
     * @return Route : retourne la route pouvoir enchainer les fonctions
     */
    public function get($path,$callable)
    {
        return $this->map($path,$callable,'GET');
    }

    public function post($path,$callable)
    {
        return $this->map($path,$callable,'POST');
    }

    public function delete($path,$callable)
    {
        return $this->map($path,$callable,'DELETE');
    }

    /***
     * @param $path : Chemin de la route
     * @param $callable : Fonction appelée en fonction de la route
     * @param $method : Request method
     * @return Route : retourne la route pouvoir enchainer les fonctions
     */
    private function map($path,$callable,$method)
    {
        $route = new Route($path,$callable);

        $this->routes[$method][] = $route;
        return $route; //pour enchainer les méthodes
    }

    /**
     * @throws RouterException
     */
    public function run(){

        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
            throw new RouterException('REQUEST_METHOD does not exist');
        }
        //problème ici
        /***
         * @var $route Route
         */
        /*foreach($this->routes["POST"] as $route){
            $_SERVER['REQUEST_METHOD'] = "POST";
            if($route->match($this->url)){
                return $route->call();
            }
        }*/

        /***
         * @var $route Route
         */
        foreach($this->routes["GET"] as $route){
            $_SERVER['REQUEST_METHOD'] = "GET";
            if($route->match($this->url)){
                return $route->call();
            }
        }

        /***
         * @var $route Route
         */
        /*foreach($this->routes["DELETE"] as $route){
            $_SERVER['REQUEST_METHOD'] = "DELETE";
            if($route->match($this->url)){
                return $route->call();
            }
        }*/

        throw new RouterException('No matching routes');
    }

    /**
     * @return Route[]
     */
    public function getRoutes()
    {
        return $this->routes;
    }

}