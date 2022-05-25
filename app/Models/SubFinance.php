<?php

namespace App\Models;

use CodeIgniter\Model;

class SubFinance extends Model
{
    protected $table = 'sub_finances';

    protected $allowedFields = ['finance_id', 'value', 'description'];
}
