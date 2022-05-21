<?php

namespace App\Models;

use CodeIgniter\Model;

class Cart extends Model
{
    protected $table = 'carts';

    protected $allowedFields = ['product_id', 'user_id', 'quantity'];

    public function withImages()
    {
        return $this->join('product_medias', 'products.id = product_medias.product_id')->where('product_medias.type', 'image');
    }

    public function withProduct()
    {
        return $this->join('products', 'products.id = carts.product_id')->select('products.*, product_medias.*, product_medias.id AS media_id, products.id AS product_id, carts.*');
    }
}
