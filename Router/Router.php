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
     * @var Route array
     */
    private $routes = [];

    /***
     * @param string $url
     */
    public function __construct($url)
    {
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
        $route = new Route($path,$callable,$this->url,$method);

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

        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route){
            if($route->match($this->url)){
                return $route->call();
            }

        }
        throw new RouterException('No matching routes');
    }

}