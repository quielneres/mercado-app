<?php

namespace app\services;

use app\repositories\UserRepository;

class UserService
{
    private $repository;
    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function getUserEmail($email)
    {
        return $this->repository->getForEmail($email);
    }

    public function list()
    {
        return $this->repository->show();
    }

    public function verifyUser($email, $password)
    {
        $usrExist = $this->getUserEmail($email);

        if (!$usrExist) {
            echo json_encode([
                'statusCode' => 401,
                'message' => 'user not found'
            ], JSON_THROW_ON_ERROR);
            die;
        }

        if (!$this->verifyPassword($password, $usrExist->password)) {
            echo json_encode([
                'statusCode' => 401,
                'message' => 'incorrect password'
            ], JSON_THROW_ON_ERROR);
            die;
        }

        return true;
    }

    public function insert($params)
    {
        $usrExist = $this->getUserEmail($params->email);
        if ($usrExist) {
            return $usrExist;
        }

        $data = [
            'name' => $params->name,
            'email' => $params->email,
            'password' => $this->generatePassword($params->password)
        ];

        try {
            return $this->repository->insert($data);
        } catch (\Exception $exception) {
            throw new \RuntimeException($exception->getMessage());
        }
    }

    private function generatePassword($pass): string
    {
        return password_hash($pass, PASSWORD_BCRYPT);
    }

    private function verifyPassword($pass, $hash): bool
    {
        if (password_verify($pass, $hash)) {
            return true;
        }
        return false;
    }
}