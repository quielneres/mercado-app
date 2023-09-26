<?php

namespace app\repositories;

use app\models\Product;

class ProductRepository
{
    private Product $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function show(): array
    {
        return Product::all()->toArray();
    }

    public function get(int $id): ?Product
    {
        return Product::find($id);
    }

    public function insert(array $data): Product
    {
        try {
            $product = new Product([
                'id_type' => $data['id_type'],
                'description' => $data['description'],
                'price' => $data['price'],
            ]);

            $product->save();

            return $product;
        } catch (\Exception $exception) {
            throw $exception; // Você pode personalizar a manipulação de exceção conforme necessário
        }
    }

    public function edit(array $data, Product $product): Product
    {
        try {
            $product->id_type = $data['id_type'];
            $product->description = $data['description'];
            $product->price = $data['price'];
            $product->save();

            return $product;
        } catch (\Exception $exception) {
            throw $exception; // Personalize conforme necessário
        }
    }
}