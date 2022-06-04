<?php

namespace App\Models;

use CodeIgniter\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $allowedFields = ['user_id', 'product_id', 'sub_product_id', 'shipping_id', 'quantity'];

    public function withProduct()
    {
        return $this->join('products', 'products.id = orders.product_id')->select('products.*, product_medias.*, product_medias.id AS media_id, products.id AS product_id, orders.*, 
                                                                                                    sub_products.price AS sub_product_price, sub_products.stock AS sub_product_stock, 
                                                                                                    sub_products.unit AS sub_product_unit,
                                                                                                    sub_products.id AS sub_product_id');
    }

    public function withSubProduct()
    {
        return $this->join('sub_products', 'sub_products.id = orders.sub_product_id');
    }

    public function withImages()
    {
        return $this->join('product_medias', 'products.id = product_medias.product_id')->where('product_medias.type', 'image');
    }
}
