<?php

namespace app\controllers;

use app\services\UserService;

class AuthController extends Controller
{
    private static $key = '123456'; //Application Key
    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function login($params)
    {
        if ($this->userService->verifyUser($params->email, $params->password)) {
            //Header Token
            $header = [
                'typ' => 'JWT',
                'alg' => 'HS256'
            ];

            //Payload - Content
            $payload = [
                'name' => 'Rafael Capoani',
                'email' => $_POST['email'],
            ];

            //JSON
            $header = json_encode($header);
            $payload = json_encode($payload);

            //Base 64
            $header = self::base64UrlEncode($header);
            $payload = self::base64UrlEncode($payload);

            //Sign
            $sign = hash_hmac('sha256', $header . "." . $payload, self::$key, true);
            $sign = self::base64UrlEncode($sign);

            //Token
            $token = $header . '.' . $payload . '.' . $sign;

            $data = [
                'token' => $token,
                'user' => $this->userService->getUserEmail($params->email)
            ];

            return $this->response($data);
        }

        echo json_encode('Não autenticado');die();

    }

    public static function checkAuth()
    {
        $http_header = apache_request_headers();

        if (isset($http_header['Authorization']) && $http_header['Authorization'] != null) {
            $bearer = explode(' ', $http_header['Authorization']);
            //$bearer[0] = 'bearer';
            //$bearer[1] = 'token jwt';

            $token = explode('.', $bearer[1]);
            $header = $token[0];
            $payload = $token[1];
            $sign = $token[2];

            //Conferir Assinatura
            $valid = hash_hmac('sha256', $header . "." . $payload, self::$key, true);
            $valid = self::base64UrlEncode($valid);

            if ($sign === $valid) {
                return true;
            }
        }

        echo json_encode([
            'statusCode' => 401,
            'message' => 'login required'
        ], JSON_THROW_ON_ERROR);
        die;
    }


    /*Criei os dois métodos abaixo, pois o jwt.io agora recomenda o uso do 'base64url_encode' no lugar do 'base64_encode'*/
    private static function base64UrlEncode($data)
    {
        // First of all you should encode $data to Base64 string
        $b64 = base64_encode($data);

        // Make sure you get a valid result, otherwise, return FALSE, as the base64_encode() function do
        if ($b64 === false) {
            return false;
        }

        // Convert Base64 to Base64URL by replacing “+” with “-” and “/” with “_”
        $url = strtr($b64, '+/', '-_');

        // Remove padding character from the end of line and return the Base64URL result
        return rtrim($url, '=');
    }
}