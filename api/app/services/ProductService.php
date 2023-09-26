<?php

namespace app\services;

use app\repositories\ProductRepository;
class ProductService
{
    private ProductRepository $repository;
    private $productId;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }
    public function getId()
    {
        return $this->repository->get($this->productId);
    }

    public function list()
    {
        return $this->repository->show();
    }
    public function edit($params)
    {
        $this->productId = $params->id;

        $data = [
            'id' => $params->id,
            'id_type' => $params->id_type,
            'description' => $params->description,
            'price' => $params->price
        ];

        $productId = $this->getId();

        if(!isset($productId)) {
            echo json_encode([
                'statusCode' => 204,
                'message' => 'product not found'
            ], JSON_THROW_ON_ERROR);
            die;
        }

        try {
            return $this->repository->edit($data, $productId);
        } catch (\Exception $exception) {
            throw new \RuntimeException($exception->getMessage());
        }
    }
}