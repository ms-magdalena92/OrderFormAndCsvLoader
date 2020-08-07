<?php

namespace Core;

abstract class Controller
{
    protected $routeParams = [];
    
    public function __construct($routeParams)
    {
        $this -> routeParams = $routeParams;
    }
    
    public function __call($name, $args)
    {
        $method = $name.'Action';
        
        if (method_exists($this, $method)) {
            
            call_user_func_array([$this, $method], $args);

        } else {
            
            throw new \Exception("Method not found in the controller.");
        }
    }
}
