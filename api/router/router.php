<?php

use Pimple\Container;
use app\controllers\ProductController;
use app\repositories\ProductRepository;
use app\services\ProductService;
use app\models\Product;
use app\Dependecies;

//$dependece = new Dependecies();
//$dependece->setDependecies();

$container = new Container();

$container['Product'] = function ($c) {
    return new Product();
};

$container['ProductRepository'] = function ($c) {
    return new ProductRepository($c['Product']);
};

$container['ProductService'] = function ($c) {
    return new ProductService($c['ProductRepository']);
};

$container['ProductController'] = function ($c) {
    return new ProductController($c['ProductService'], $c['ProductRepository']);
};


$routers = [
    'GET' => [
        '/home' => static fn() => load('HomeController', 'index'),
        '/products' => static function () use ($container) {
            $container['ProductController']->index();
        },
        '/products-types' => static fn() => load('ProductTypeController', 'index'),
        '/users' => static fn() => load('UserController', 'index'),
        '/sales' => static fn() => load('CheckoutController', 'index')
    ],
    'POST' => [
        '/user' => static fn() => load('UserController', 'store'),
        '/login' => static fn() => load('AuthController', 'login'),
        '/products' => static function () use ($container) {
            $json = file_get_contents('php://input');
            $params = (object)$_REQUEST;

            if (!empty($json)) {
                $params = (object)json_decode($json);
            }
            $container['ProductController']->store($params);
        },
        '/products/update' => static function () use ($container) {
            $json = file_get_contents('php://input');
            $params = (object)$_REQUEST;

            if (!empty($json)) {
                $params = (object)json_decode($json);
            }
            $container['ProductController']->update($params);
        },
//        '/products/update' => static fn() => load('ProductController', 'update', true),
        '/products-types' => static fn() => load('ProductTypeController', 'store', true),
        '/products-types/update' => static fn() => load('ProductTypeController', 'update', true),
        '/products-types/get' => static fn() => load('ProductTypeController', 'getProductType'),
        '/checkout' => static fn() => load('CheckoutController', 'store')
    ]
];

function load(string $controller, string $action,bool $auth = false)
{
    $json = file_get_contents('php://input');

    if ($auth) {
        \app\controllers\AuthController::checkAuth();
    }

    try {
        $controllerNamespace = "app\\controllers\\$controller";

        if (!class_exists($controllerNamespace)) {
            throw new Exception("{$controller} not found!");
        }

        $controllerInstance = new $controllerNamespace();

        if (!method_exists($controllerNamespace, $action)) {
            throw new Exception("method {$controller} not found at the controller {$controllerNamespace}!");
        }

        $params = (object)$_REQUEST;

        if (!empty($json)) {
            $params = (object)json_decode($json);
        }

        $controllerInstance->$action($params);

    } catch (Exception $exception) {
        echo $exception->getMessage();
    }
}