<?php

namespace Router;

class Route
{

    private $path;
    private $callable;
    private $matches = [];

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
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);

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

    /***
     * On appel la function annonyme et on utilise cela avec les paramètres récupéré dans matches
     * @return false|mixed
     */
    public function call(){
        return call_user_func_array($this->callable, $this->matches);
    }

}