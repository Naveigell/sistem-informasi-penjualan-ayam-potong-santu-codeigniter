<?php

namespace App\Models;

use CodeIgniter\Model;

class Finance extends Model
{
    protected $table = 'finances';

    public const TYPE_EXPENDITURE = 'expenditure';

    protected $allowedFields = ['rand_date', 'finance_type', 'publish_date'];
}
