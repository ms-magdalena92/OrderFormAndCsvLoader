<?php

require_once '../Core/Router.php';
require '../App/Controllers/Home.php';

$router = new Core\Router();

$router -> addRoute('', ['controller' => 'Home', 'action' => 'index']);
$router -> addRoute('{controller}/{action}');

$url = $_SERVER['QUERY_STRING'];

$router -> dispatchRoute($url);
