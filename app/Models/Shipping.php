<?php

namespace App\Models;

use CodeIgniter\Model;

class Shipping extends Model
{
    public const STATUS_ON_PROGRESS = 'on_progress';
    public const STATUS_WAITING_PAYMENT = 'waiting_payment';

    protected $table = 'shippings';

    protected $allowedFields = ['user_id', 'area_id', 'name', 'email', 'address', 'phone', 'total', 'weight', 'payment_option', 'status'];
}
