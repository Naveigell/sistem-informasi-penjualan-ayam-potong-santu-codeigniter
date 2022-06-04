<?php

namespace App\Models;

use CodeIgniter\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $allowedFields = ['name', 'weight', 'price', 'slug', 'category_id', 'stock', 'description', 'unit'];

    public function withImages()
    {
        return $this->join('product_medias', 'products.id = product_medias.product_id')->where('product_medias.type', 'image');
    }

    public function withCategory()
    {
        return $this->join('product_categories', 'products.category_id = product_categories.id')->select('products.*, product_medias.*, product_categories.name AS category_name');
    }
}
