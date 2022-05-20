<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ReviewsTable extends Migration
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
            'user_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'product_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'shipping_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'star' => [
                'type' => 'TINYINT',
                'constraint' => 3,
            ],
            'description' => [
                'type' => 'TEXT',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('shipping_id', 'shippings', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('reviews');
    }

    public function down()
    {
        $this->forge->dropTable('reviews');
    }
}
