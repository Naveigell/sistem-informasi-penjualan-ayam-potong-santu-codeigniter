<?php

namespace App\Models;

use CodeIgniter\Model;

class ShippingHistory extends Model
{
    protected $table = 'shipping_histories';

    protected $allowedFields = ['shipping_id', 'index_id', 'description', 'progress_date'];
}
