<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SubProductsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'product_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'price' => [
                'type' => 'INT',
                'constraint' => 100,
                'unsigned' => true,
            ],
            'stock' => [
                'type' => 'INT',
                'constraint' => 100,
                'unsigned' => true,
            ],
            'unit' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('sub_products');
    }

    public function down()
    {
        $this->forge->dropTable('sub_products');
    }
}
