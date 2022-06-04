<?php

namespace App\Models;

use CodeIgniter\Model;

class Review extends Model
{
    protected $table = 'reviews';

    protected $allowedFields = ['user_id', 'product_id', 'sub_product_id', 'shipping_id', 'star', 'description'];

    public function withUser()
    {
        return $this->join('users', 'users.id = reviews.user_id');
    }
}
