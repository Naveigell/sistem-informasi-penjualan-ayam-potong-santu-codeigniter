<?php

namespace App\Models;

use CodeIgniter\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $allowedFields = ['name', 'weight', 'price'];
}
