<?php
namespace Router;
require_once ('Route.php');
require_once ('RouterException.php');
class Router
{

    private $url; // Contiendra l'URL sur laquelle on souhaite se rendre
    /***
     * @var Route[] $routes
     */
    private $routes = []; // Contiendra la liste des routes
    private $name_route = [];
    /***
     * @param string $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /***
     * @param $path : Url du get
     * @param $callable : fonction annonyme qui sera lancée lors de l'appel
     *
     */
    public function map($path,$callable,$name,$method)
    {
        $this->add($path,$callable,$name,$method);
    }


    private function add($path,$callable,$name = null,$method){
        $route = new Route($path,$callable);
        //Ici on index le tableau pour trier nos routes, ici on push des routes en get
        $this->routes[$method][] = $route;

        if (is_string($callable) && $name === null)
        {
            $name = $callable;
        }

        if($name)
        {
            $this->name_route[$name] = $route;
        }

        return $route;
    }

    /***
     * Fonction qui vérifie si l'url correspond au url entrée
     * @throws RouterException
     */
    public function run()
    {
        //On récupère la méthode utilisée par la route
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
            //Si la méthode n'existe pas dans le tableau --> exeption
            throw new RouterException('REQUEST_METHOD Does not exist');
        }
        //Si tout est bon : parcours de toutes les routes
        /***
         * @var Route $route
         */
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route)
        {
            if($route->match($this->url))
            {
                $route->call();
            }
        }

        throw new RouterException('No matching routes');
    }

    public function url($nameRoute,$params = [])
    {
        if(!isset($this->name_route[$nameRoute])){
            throw new RouterException('No route math this name');
        }

        $this->name_route[$nameRoute]->getUrl($params);

    }
}