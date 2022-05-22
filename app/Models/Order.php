<?php

namespace App\Models;

use CodeIgniter\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $allowedFields = ['user_id', 'product_id', 'shipping_id', 'quantity'];
}
