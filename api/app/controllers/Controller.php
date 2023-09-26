<?php

namespace app\controllers;

use League\Plates\Engine;

class Controller
{
    public static function view(string $view, array $data = [], $statusCode = 200): void
    {
        $viewsPath = dirname(__FILE__, 2) . "/views";
        $templates = new Engine($viewsPath);
        echo $templates->render($view, $data);
    }

    public function response($data): void
    {
        echo json_encode([
            'statusCode' => 200,
            'data' => $data
        ], JSON_THROW_ON_ERROR);
    }

}