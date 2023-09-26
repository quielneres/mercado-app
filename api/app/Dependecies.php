<?php
namespace app;

use app\controllers\ProductController;
use app\repositories\ProductRepository;
use app\services\ProductService;
use Pimple\Container;

class Dependecies
{
    public function setDependecies()
    {
        $container = new Container();

        $container['ProductRepository'] = function ($c) {
            return new ProductRepository();
        };

        $container['ProductService'] = function ($c) {
            return new ProductService($c['ProductRepository']);
        };

        $container['ProductController'] = function ($c) {
            return new ProductController($c['ProductService'], $c['ProductRepository']);
        };

        return $container;
    }
}