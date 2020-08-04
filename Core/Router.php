<?php

namespace Core;

class Router {
    
    protected $routes = [];
    
    protected $routeParams = [];
    
    protected function changeIntoRegEx($route) 
    {
        $route = preg_replace('/\//', '\\/', $route);
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
        $route = '/^' . $route . '$/i';
        
        return $route;
    }
    
    public function addRoute($route, $params = [])
    {
        $route = $this -> changeIntoRegEx($route);
        $this -> routes[$route] = $params;
    }
    
    public function matchUrlToRoutes($url)
    {
        foreach ($this -> routes as $route => $params) {
            
            if (preg_match($route, $url, $matches)) {
                
                foreach ($matches as $paramName => $value) {
                    
                    if (is_string($paramName)) {
                        
                        $params[$paramName] = $value;
                    }
                }
                
                $this -> routeParams = $params;
                
                return true;
            }
        }
        
        return false;
    }

    public function dispatchRoute($url)
    {
        if ($this -> matchUrlToRoutes($url)) {
            
            $this -> createControlerAndRunActionMethod();
            
        } else {
            
            throw new \Exception('No route matched.');
        }
    }
    
    protected function createControlerAndRunActionMethod()
    {
        $calledController = $this -> routeParams['controller'];
        $calledController = $this -> convertToStudlyCaps($calledController);
        $calledController = "App\Controllers\\$calledController";
        
        if (class_exists($calledController)) {
            
            $controller = new $calledController($this -> routeParams);
            
            $action = $this -> routeParams['action'];
            $action = $this -> convertToCamelCase($action);
            
            if (preg_match('/action$/i', $action) == 0) {
                
                $controller -> $action();
                
            } else {
                
                throw new \Exception("Method not found");
            }
            
        } else {
            
            throw new \Exception("Controller not found");
        }
    }

    protected function convertToStudlyCaps($controller)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $controller)));
    }

    protected function convertToCamelCase($action)
    {
        return lcfirst($this -> convertToStudlyCaps($action));
    }
}
