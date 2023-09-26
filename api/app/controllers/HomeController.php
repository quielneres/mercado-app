<?php

namespace app\controllers;
class HomeController extends Controller
{
    public function index($params)
    {
        var_dump($params);
       return Controller::view("home");
    }
    public function greet(string $name): string
    {
        return 'Hello, ' . $name . '!';
    }
}