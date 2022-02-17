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
     * Contiendra toutes les routes du router
     * @var Route[] $routes
     */
    private $routes;
    private $method;
    /***
     * @var $nameRoutes array : tableau qui stock la route
     */
    private $nameRoutes = [];


    /***
     * @param string $url
     */
    public function __construct($url)
    {
        $this->routes = [];
        $this->url = $url;
    }

    public function get($path,$callable,$nameRoute=null)
    {
        return $this->map($path,$callable,$nameRoute,'GET');
    }

    public function post($path,$callable,$nameRoute=null)
    {
        return $this->map($path,$callable,$nameRoute,'POST');
    }

    public function delete($path,$callable,$nameRoute=null)
    {
        return $this->map($path,$callable,$nameRoute,'DELETE');
    }


    private function map($path,$callable,$nameRoute,$method)
    {
        $route = new Route($path,$callable);
        //Ajouter dans le tableau indexé en get toutes les routes en get
        $this->routes[$method][] = $route;
        $this->method = $method;

        //S'il y a un nom pour la route on stock la route dans l'index du nom de la route

        /*if($nameRoute)
        {
            $this->nameRoutes[$nameRoute] = $route;
        }*/

        return $route; //pour enchainer les méthodes
    }

    /**
     * @throws RouterException
     */
    public function run()
    {


        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
            throw new RouterException('REQUEST_METHOD does not exist');
        }
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route){
            if($route->match($this->url)){
                return $route->call();
            }
        }
        throw new RouterException('No matching routes');



/*
        //Si dans le tableau de route il n'y pas la méthode retourner une exeption pour dire que la méthode n'existe pas dans le tableau
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
            throw new RouterException('REQUEST_METHOD does not exist');
        }
        //Si toutes les méthodes existes -> boucler sur toutes routes pour pouvoir vérifier si ça match
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route){



            if($route->match($this->url)){
                return $route->call();
            }
        }*/

        //Sinon pas de route de trouvée
        //throw new RouterException('No matching routes');
    }

    /**
     * @throws RouterException
     */
    public function url($nameRoute, $params = [])
    {
        if(!isset($this->nameRoutes[$nameRoute])){
            throw new RouterException("No route matches this name");
        }

        return $this->nameRoutes[$nameRoute]->getUrl($params);
    }
}