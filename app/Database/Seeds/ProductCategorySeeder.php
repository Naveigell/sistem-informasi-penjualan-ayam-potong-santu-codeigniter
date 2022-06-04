<?php

namespace App\Database\Seeds;

use App\Models\ProductCategory;
use CodeIgniter\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Ayam Putih',
                'slug' => 'ayam-putih',
            ],
            [
                'name' => 'Ayam Merah',
                'slug' => 'ayam-merah',
            ],
        ];

        (new ProductCategory())->insertBatch($data);
    }
}
