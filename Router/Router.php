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

    /***
     * @param string $url
     */
    public function __construct($url)
    {
        $this->routes = [];
        $this->url = $url;
    }

    public function get($path,$callable)
    {
        $route = new Route($path,$callable);
        //Ajouter dans le tableau indexé en get toutes les routes en get
        $this->routes['GET'][] = $route;
        return $route; //pour enchainer les méthodes
    }

    /**
     * @throws RouterException
     */
    public function run()
    {
        //Si dans le tableau de route il n'y pas la méthode retourner une exeption pour dire que la méthode n'existe pas dans le tableau
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
            throw new RouterException('REQUEST_METHOD does not exist');
        }
        //Si toutes les méthodes existes -> boucler sur toutes routes pour pouvoir vérifier si ça match
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route){
            /***
             * @var Route $route
             */

            if($route->match($this->url)){
                return $route->call();
            }
        }
        //Sinon pas de route de trouvée
        throw new RouterException('No matching routes');
    }
}