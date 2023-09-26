<?php

namespace app\repositories;

use app\models\User;

class UserRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function show()
    {
        return User::select('id', 'name', 'email')->get();
    }

    public function get($id)
    {
        return User::find($id);
    }

    public function getForEmail($email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function insert($data): User
    {
        try {
            $this->model->name = $data['name'];
            $this->model->email = $data['email'];
            $this->model->password = $data['password'];
            $this->model->save();

            return $this->model;
        } catch (\Exception $exception) {
            throw new \RuntimeException($exception->getMessage());
        }
    }

    public function edit($data , User $productType): User
    {
        try {
            $productType->description = $data['description'];
            $productType->tax_percentage = $data['tax_percentage'];
            $productType->update();
            return $productType;
        } catch (\Exception $exception) {
            throw new \RuntimeException($exception->getMessage());
        }
    }
}