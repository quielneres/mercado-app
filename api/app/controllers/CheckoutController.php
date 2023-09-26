<?php

namespace app\controllers;
use app\services\CheckoutService;

class CheckoutController extends Controller
{
    private $service;
    public function __construct()
    {
        $this->service = new CheckoutService();
    }

    public function index()
    {
        return $this->response($this->service->list());
    }

    public function store($params)
    {
        return $this->response($this->service->finishCheckout($params));
    }

}