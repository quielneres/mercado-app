<?php

namespace app\repositories;

use app\models\ProductType;

class ProductTypeRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new ProductType();
    }

    public function show()
    {
        return ProductType::all();
    }

    public function get($id)
    {
        return ProductType::find($id);
    }

    public function insert($data): ProductType
    {
        try {
            $this->model->description = $data['description'];
            $this->model->tax_percentage = $data['tax_percentage'];
            $this->model->save();

            return $this->model;
        } catch (\Exception $exception) {
            throw new \RuntimeException($exception->getMessage());
        }
    }

    public function edit($data , ProductType $productType): ProductType
    {
        try {
            $productType->description = $data['description'];
            $productType->tax_percentage = $data['tax_percentage'];
            $productType->update();
            return $productType;
        } catch (\Exception $exception) {
            throw new \RuntimeException($exception->getMessage());
        }
    }
}