<?php

namespace Router;

class Route
{

    private $path;
    private $callable;
    private $matches = [];
    private $params = [];

    /***
     * @param string $path : url de la route
     * @param $callable : fonction qui sera appelée
     */
    public function __construct($path, $callable){
        $this->path = trim($path, '/');  // On retire les / inutile
        $this->callable = $callable;
    }

    /***
     * Cette méthode regarde si la route passée en paramètre match avec le $path
     *
     * @param $url
     * @return bool
     */
    public function match($url){
        $url = trim($url, '/'); //Enlever les espaces du début et finaux
        //Transform url --> remplacer le paramètre qui est derrière les : en tout ce qui n'est pas un /
        //$path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $path = preg_replace_callback('#:([\w]+)#',[$this,"paramMatch"] , $this->path);

        //#^$#-> vérifie le début à la fin la chaine
        //#i -> vérifie majuscule et minuscule -> case sensitive
        $regex = "#^$path$#i";

        //Url ne correspond pas
        if(!preg_match($regex, $url, $matches)){
            return false;
        }

        array_shift($matches); //enlever le premier élément du tableau car on récupère l'entièreté de l'url
        $this->matches = $matches;  // On sauvegarde les paramètres dans l'instance pour plus tard

        return true;
    }

    private function paramMatch($match)
    {
        if(isset($this->params[$match[1]]))
        {

            return '('.$this->params[$match[1]].')';
        }

        return '([^/]+)';
    }

    /***
     * On appel la function annonyme et on utilise cela avec les paramètres récupéré dans matches
     * @return false|mixed
     */
    public function call(){
        return call_user_func_array($this->callable, $this->matches);
    }

    /***
     * @param $name_params
     * @param $regex
     * @return $this
     */
    public function with($name_params, $regex)
    {
        //Supprimer les () --> (?: on ne capture pas les ()

        //Stocker le paramètres avec son expression régulière
        $this->params[$name_params] = str_replace('(','(?:',$regex);
        return $this; // fluent pour enchainer les arguments
    }

    public function getUrl($params)
    {
        $path = $this->path;

        foreach ($params as $param => $k) {
            $path = str_replace(":$param",$k,$path);
        }

        return $path;
    }

}