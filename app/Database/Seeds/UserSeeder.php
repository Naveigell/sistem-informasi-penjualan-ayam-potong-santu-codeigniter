<?php

namespace App\Database\Seeds;

use App\Models\User;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin123',
                'name'     => 'admin',
                'email'    => 'admin@gmail.com',
                'password' => password_hash(123456, PASSWORD_DEFAULT),
                'role'     => User::ROLE_ADMIN,
            ],
            [
                'username' => 'member',
                'name'     => 'member',
                'email'    => 'member@gmail.com',
                'password' => password_hash(123456, PASSWORD_DEFAULT),
                'role'     => User::ROLE_USER,
            ],
            [
                'username' => 'member123',
                'name'     => 'member123',
                'email'    => 'member123@gmail.com',
                'password' => password_hash(123456, PASSWORD_DEFAULT),
                'role'     => User::ROLE_USER,
            ],
        ];

        (new User())->insertBatch($data);
    }
}
