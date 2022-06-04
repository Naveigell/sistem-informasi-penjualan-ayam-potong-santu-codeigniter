<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $seeder = \Config\Database::seeder();
        $seeder->call('UserSeeder');
        $seeder->call('ProductCategorySeeder');
        $seeder->call('AreaSeeder');
    }
}
