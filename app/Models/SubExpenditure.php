<?php

namespace App\Models;

use CodeIgniter\Model;

class SubExpenditure extends Model
{
    protected $table = 'sub_expenditures';

    protected $allowedFields = ['expenditure_id', 'name', 'quantity', 'nominal', 'description'];
}
