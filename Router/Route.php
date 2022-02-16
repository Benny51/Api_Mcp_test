<?php

namespace Router;

class Route
{
    /**
     * @var string $path
     */
    private $path;
    private $matches = [];
    private $callable;
    private $params = [];

    /**
     * @param string $path
     * @param  $callable
     */
    public function __construct($path, $callable)
    {
        $this->path = trim($path);
        $this->callable = $callable;
    }

    public function match($url)
    {

        //enlever les / initiaux et finaux
        $url = trim($url,'/');

        //transformer l'url lorsqu'il y a des paramètres

        //remplacer par une fonction dans le callback
        var_dump($this->path);
        $path = preg_replace('#:([\w]+)#','([^/]+)',$this->path);
        //enlever les / début et finaux du pâth dans le constructeur
        var_dump($path);
        //Vérifier l'url du début à la fin ^ début et $ pour la fin et au centre le path
        //Le drapeau i : vérifie majuscule et minuscule
        $regex = "#^$path$#i";
        var_dump($regex);

        var_dump(!preg_match($regex,$url,$matches));
        //LE BUG EST ICI
        //Si l'url ne correspond pas
        if(!preg_match($regex,$url,$matches))
        {
            return false;
        }

        var_dump($matches);
        //Enlève le premier élément du tableau
        //array_shift($matches);
        $this->matches = $matches;

        return true;
    }

    private function paramMatch($match)
    {
        //pour récupérer le premier param id dans l'exemple
        if(isset($this->params[$match[1]]))
        {
            return '('.$this->params[$match[1]].')';
        }

        return  '([^/]+)';

    }


    public function call()
    {

        var_dump($this->matches);

        if(is_string($this->callable))
        {
            $params = explode("#",$this->callable);
            //Je devrais demain faire les controllers et mettre ca dedans //Ici je vais chercher la méthode du modèle
            $controller = "..\\Model\\".$params[0];

            return call_user_func_array([$controller,$params[1]],$this->matches);
        }
        //On appelle la fonction anonyme
        return call_user_func_array($this->callable,$this->matches);
    }

    public function with($param, $regex)
    {
        //Stocker les paramètres
        $this->params[$param] = str_replace('(','(?:',$regex); // bloquer les parenthèse dans l'url
        return $this; // return this pour pouvoir enchainer les with car return instance de route
    }

    public function getUrl($params)
    {

        $path = $this->path;

        foreach ($params as $k => $v)
        {
            //$k = id
            $path = str_replace(":$k",$v,$path);
        }

        return $path;
    }


}