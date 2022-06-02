<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterCartsTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('carts', [
            'sub_product_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'after' => 'product_id',
                'null' => false,
            ],
            'CONSTRAINT carts_sub_product_id_foreign FOREIGN KEY(`sub_product_id`) REFERENCES `sub_products`(`id`) ON DELETE CASCADE ON UPDATE CASCADE',
        ]);
    }

    public function down()
    {
        $this->forge->dropForeignKey('carts', 'carts_sub_product_id_foreign');
        $this->forge->dropColumn('carts', 'sub_product_id');
    }
}
