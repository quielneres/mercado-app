<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    protected $fillable = ['id_type', 'description', 'price'];
}