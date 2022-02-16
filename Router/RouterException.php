<?php

namespace Router;

class RouterException extends \Exception
{

    /**
     * @param string $string
     */
    public function __construct($string)
    {
        echo $string;
    }
}