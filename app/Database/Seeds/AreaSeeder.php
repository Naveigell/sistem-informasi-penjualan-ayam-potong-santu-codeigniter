<?php

namespace App\Database\Seeds;

use App\Models\ShippingCost;
use CodeIgniter\Database\Seeder;

class AreaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                "area" => "Gianyar",
                "cost" => 50000,
            ],
            [
                "area" => "Kintamani",
                "cost" => 30000,
            ],
        ];

        (new ShippingCost())->insertBatch($data);
    }
}
