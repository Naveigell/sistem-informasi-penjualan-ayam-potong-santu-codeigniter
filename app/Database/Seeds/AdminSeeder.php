<?php

namespace App\Database\Seeds;

use App\Models\User;
use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'admin123',
            'name'     => 'admin',
            'email'    => 'admin@gmail.com',
            'password' => password_hash(123456, PASSWORD_DEFAULT),
            'role'     => User::ROLE_ADMIN,
        ];

        (new User())->insert($data);
    }
}
