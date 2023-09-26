<?php

namespace app\services;

use app\repositories\ProductTypeRepository;
class ProductTypeService
{
    private $repsitory;
    private $productTypeId;
    public function __construct()
    {
        $this->repsitory = new ProductTypeRepository();
    }

    public function getId()
    {
        return $this->repsitory->get($this->productTypeId);
    }

    public function list()
    {
        return $this->repsitory->show();

    }
    public function edit($params)
    {
        $this->productTypeId = $params->id;

        $data = [
            'id' => $params->id,
            'description' => $params->description,
            'tax_percentage' => $params->taxPercentage
        ];

        $productType = $this->getId();

        if(!isset($productType)) {
            echo json_encode([
                'statusCode' => 204,
                'message' => 'product type not found'
            ], JSON_THROW_ON_ERROR);
            die;
        }

        try {
            return $this->repsitory->edit($data, $productType);
        } catch (\Exception $exception) {
            throw new \RuntimeException($exception->getMessage());
        }
    }
}