<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    public const ROLE_USER  = 'user';
    public const ROLE_ADMIN = 'admin';

    protected $table = 'users';

    protected $allowedFields = ['name', 'username', 'email', 'password', 'phone', 'address', 'role'];
}
