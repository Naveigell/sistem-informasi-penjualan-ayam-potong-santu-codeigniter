<?php

namespace App\Models;

use CodeIgniter\Model;

class Capital extends Model
{
    protected $table = 'capitals';

    protected $allowedFields = ['value', 'publish_date'];
}
