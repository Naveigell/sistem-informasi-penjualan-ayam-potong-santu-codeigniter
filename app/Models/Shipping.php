<?php

namespace App\Models;

use CodeIgniter\Model;

class Shipping extends Model
{
    public const STATUS_ON_PROGRESS = 'on_progress';
    public const STATUS_WAITING_PAYMENT = 'waiting_payment';

    protected $table = 'shippings';

    protected $allowedFields = [
        'user_id', 'area_id', 'order_id', 'name', 'email', 'address', 'phone', 'total', 'weight', 'payment_option',
        'status', 'finished', 'finished_date', 'has_read',
        ];

    public function withUser()
    {
        return $this->join('users', 'users.id = shippings.user_id')->select('users.*');
    }

    public function withArea()
    {
        return $this->join('shipping_costs', 'shipping_costs.id = shippings.area_id')->select('shipping_costs.*');
    }

    public function withPayment()
    {
        return $this->join('payments', 'payments.shipping_id = shippings.id', 'LEFT')->select('payments.*, payments.status AS payment_status, shippings.*, shippings.id AS shipping_id');
    }
}
