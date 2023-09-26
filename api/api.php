<?php
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json, charset=utf-8');
require 'vendor/autoload.php';
require 'bootstrap.php';
require 'router/router.php';

try {
    $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
    $request = $_SERVER['REQUEST_METHOD'];

    if(!isset($routers[$request])){
        throw new \RuntimeException('Route not found!');
    }

    if(!array_key_exists($uri, $routers[$request])){
        throw new \RuntimeException('Route not found!');
    }

    $controller = $routers[$request][$uri];
    $controller();

} catch (Exception $exception) {
    echo $exception->getMessage();
}
