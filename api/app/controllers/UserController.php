<?php

namespace app\controllers;

use app\services\UserService;

class UserController extends Controller
{
    private $service;
    public function __construct()
    {
        $this->service = new UserService();
    }

    public function index()
    {
        return $this->response($this->service->list());
    }
    public function store($params)
    {
        return $this->response($this->service->insert($params));
    }
}