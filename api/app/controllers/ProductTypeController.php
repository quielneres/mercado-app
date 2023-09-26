<?php

namespace app\controllers;

use app\repositories\ProductTypeRepository;
use app\services\ProductTypeService;

class ProductTypeController extends Controller
{
    private $service;
    private $repository;
    public function __construct()
    {
        $this->service = new ProductTypeService();
        $this->repository = new ProductTypeRepository();
    }

    public function index()
    {
        return $this->response($this->service->list());
    }

    public function getProductType($params)
    {
        return $this->response($this->repository->get($params->id));
    }

    public function store($params)
    {
        $data = [
            'description' => $params->description,
            'tax_percentage' => $params->taxPercentage
        ];

        return $this->response($this->repository->insert($data));
    }

    public function update($params)
    {
        return $this->response($this->service->edit($params));
    }
}