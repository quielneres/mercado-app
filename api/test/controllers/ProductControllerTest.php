<?php

namespace controllers;

use app\models\Product;
use app\repositories\ProductRepository;
use app\services\ProductService;
use PHPUnit\Framework\TestCase;
use app\controllers\ProductController;
use Pimple\Container;
use Illuminate\Database\Capsule\Manager as Capsule;

class ProductControllerTest extends TestCase
{

    private $container;

    public function setUp(): void
    {
        parent::setUp();


        $capsule = new Capsule;

        $capsule->addConnection([
            'driver' => 'sqlite',
            'database' => ':memory:',
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();


        $this->container = new Container();

        $this->container['Product'] = function ($c) {
            return new Product();
        };

        $this->container['ProductRepository'] = function ($c) {
            return new ProductRepository($c['Product']);
        };

        $this->container['ProductService'] = function ($c) {
            return new ProductService($c['ProductRepository']);
        };
    }

    public function testIndex()
    {

        $controller = new ProductController(
            $this->container['ProductService'],
            $this->container['ProductRepository']
        );

        $result = $controller->index();

        $this->assertEquals(['product1', 'product2'], $result);
    }

    public function testStore()
    {

        $controller = new ProductController(
            $this->container['ProductService'],
            $this->container['ProductRepository']
        );

        $data = [
            'id_type' => 1,
            'description' => 'Produto de teste',
            'price' => 19.99,
        ];


        $result = $controller->store((object)$data);
        $this->assertEquals(['product1', 'product2'], $result);

    }

    public function testUpdate()
    {
        $controller = new ProductController(
            $this->container['ProductService'],
            $this->container['ProductRepository']
        );

        $data = [
            'id' => 1,
            'id_type' => 2,
            'description' => 'Produto atualizado',
            'price' => 29.99,
        ];


        $result = $controller->update((object)$data);

        $this->assertEquals(['product1', 'product2'], $result);
    }
}