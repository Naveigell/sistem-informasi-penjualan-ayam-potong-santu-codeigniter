<?php

namespace App\Models;

use CodeIgniter\Model;

class Payment extends Model
{
    public const STATUS_WAITING = 'waiting';
    public const PAYMENT_COD = 'cod';
    public const PAYMENT_BANK_TRANSFER = 'bank_transfer';

    protected $table = 'payments';

    protected $allowedFields = ['shipping_id', 'proof', 'sender_bank', 'sender_account_number', 'sender_name', 'merchant_bank', 'status'];
}
