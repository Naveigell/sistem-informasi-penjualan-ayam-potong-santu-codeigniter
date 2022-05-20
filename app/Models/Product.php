<?php

namespace App\Models;

use CodeIgniter\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $allowedFields = ['name', 'weight', 'price', 'slug'];

    public function withImages()
    {
        return $this->join('product_medias', 'products.id = product_medias.product_id')->where('product_medias.type', 'image');
    }
}
