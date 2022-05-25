<?php

namespace App\Models;

use CodeIgniter\Model;

class Expenditure extends Model
{
    protected $table = 'expenditures';

    protected $allowedFields = ['rand_id', 'publish_date'];
}
