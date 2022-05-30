<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductCategory extends Model
{
    protected $table = 'product_categories';

    protected $allowedFields = ['name', 'slug'];
}
