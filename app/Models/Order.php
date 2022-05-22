<?php

namespace App\Models;

use CodeIgniter\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $allowedFields = ['user_id', 'product_id', 'shipping_id', 'quantity'];

    public function withProduct()
    {
        return $this->join('products', 'products.id = orders.product_id');
    }

    public function withImages()
    {
        return $this->join('product_medias', 'products.id = product_medias.product_id')->where('product_medias.type', 'image');
    }
}
