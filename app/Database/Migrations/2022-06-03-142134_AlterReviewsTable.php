<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterReviewsTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('reviews', [
            'sub_product_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'after' => 'product_id',
                'null' => false,
            ],
            'CONSTRAINT reviews_sub_product_id_foreign FOREIGN KEY(`sub_product_id`) REFERENCES `sub_products`(`id`) ON DELETE CASCADE ON UPDATE CASCADE',
        ]);
    }

    public function down()
    {
        $this->forge->dropForeignKey('reviews', 'reviews_sub_product_id_foreign');
        $this->forge->dropColumn('reviews', 'sub_product_id');
    }
}
