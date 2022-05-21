<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    public const ROLE_USER = 'user';

    protected $table = 'users';

    protected $allowedFields = ['name', 'username', 'email', 'password', 'role'];
}
