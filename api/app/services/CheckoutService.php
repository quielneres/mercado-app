<?php

namespace app\services;

use app\repositories\CheckoutRepository;
class CheckoutService
{
    private $repository;
    private $userService;
    public function __construct()
    {
        $this->repository = new CheckoutRepository();
        $this->userService = new UserService();
    }

    public function getId()
    {
        return $this->repository->get($this->productId);
    }

    public function list()
    {
        return $this->repository->show();

    }

    public function finishCheckout($params)
    {
        $user['name'] = $params->name;
        $user['email'] = $params->email;
        $user['password'] = '123456';

        $userResponse = $this->userService->insert((object)$user);

        $data = [
            'id_user' => $userResponse->id,
            'items' =>  json_encode($params->items),
            'totalAmount' => $params->totalAmount,
            'taxValue' => $params->taxValue,
            'itemsValue' => $params->itemsValue,
        ];

        try {
            return $this->repository->insert($data);
        } catch (\Exception $exception) {
            throw new \RuntimeException($exception->getMessage());
        }
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