<?php

spl_autoload_register(function ($class) {
    
	$root = dirname(__DIR__);
    $file = $root.'/'.str_replace('\\', '/', $class).'.php';

    if (is_readable($file)) {

        require $root.'/'.str_replace('\\', '/', $class).'.php';
    }
});

$router = new Core\Router();

$router -> addRoute('', ['controller' => 'Home', 'action' => 'index']);
$router -> addRoute('{controller}/{action}');

$url = $_SERVER['QUERY_STRING'];

$router -> dispatchRoute($url);
