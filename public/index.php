<?php

require_once dirname(__DIR__).'/vendor/autoload.php';

error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

$router = new Core\Router();

$router -> addRoute('', ['controller' => 'Order', 'action' => 'new']);
$router -> addRoute('{controller}/{action}');

$url = $_SERVER['QUERY_STRING'];

$router -> dispatchRoute($url);
