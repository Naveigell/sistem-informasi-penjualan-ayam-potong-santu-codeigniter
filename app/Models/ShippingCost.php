<?php

namespace App\Models;

use CodeIgniter\Model;

class ShippingCost extends Model
{
    protected $table = 'shipping_costs';

    protected $allowedFields = ['area', 'cost'];
}
