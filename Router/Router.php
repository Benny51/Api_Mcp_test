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
        $_SERVER['REQUEST_METHOD'] = $method;
        return new Route($path,$callable,$this->url,$method); //pour enchainer les méthodes
    }

}