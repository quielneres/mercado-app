<?php

namespace app\repositories;

use app\models\Checkout;

class CheckoutRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new Checkout();
    }

    public function show()
    {
        return Checkout::all();
    }

    public function get($id)
    {
        return Checkout::find($id);
    }

    public function insert($data): Checkout
    {
        try {
            $this->model->id_user = $data['id_user'];
            $this->model->items = $data['items'];
            $this->model->totalAmount = $data['totalAmount'];
            $this->model->taxValue = $data['taxValue'];
            $this->model->itemsValue  = $data['itemsValue'];
            $this->model->save();

            return $this->model;
        } catch (\Exception $exception) {
            throw new \RuntimeException($exception->getMessage());
        }
    }
}