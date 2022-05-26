<?php

namespace App\Models;

use CodeIgniter\Model;

class Suggestion extends Model
{
    protected $table = 'suggestions';

    protected $allowedFields = ['user_id', 'description', 'created_at'];

    public function withUser()
    {
        return $this->join('users', 'users.id = suggestions.user_id');
    }
}
