<?php

if(!file_exists(dirname(__DIR__) . '/vendor/'))
{
    echo "<h1>Composer Error</h1>".
         "<p>You must install the dependencies via Composer with the following command;</p>".
         "<code style='background-color: burlywood'>composer install</code>";
    return;
}

session_start();

require dirname(__DIR__) . '/vendor/autoload.php';

error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

$router = new Core\Router();
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->dispatch($_SERVER['QUERY_STRING']);