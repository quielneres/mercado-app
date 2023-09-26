<?php

namespace app\controllers;

use app\repositories\ProductRepository;
use app\services\ProductService;

class ProductController extends Controller
{
    private $service;
    private $repository;

    public function __construct(ProductService $service, ProductRepository $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->response($this->service->list());
    }

    public function store($params)
    {
        $data = [
            'id_type' => $params->id_type,
            'description' => $params->description,
            'price' => $params->price
        ];

        return $this->response($this->repository->insert($data));
    }

    public function update($params)
    {
        return $this->response($this->service->edit($params));
    }
}