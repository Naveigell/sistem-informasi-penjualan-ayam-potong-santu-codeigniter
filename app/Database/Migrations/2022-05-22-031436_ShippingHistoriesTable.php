<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ShippingHistoriesTable extends Migration
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
            'shipping_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'index_id' => [
                'type' => 'INT',
                'constraint' => 3,
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'progress_date' => [
                'type' => 'TIMESTAMP',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('shipping_id', 'shippings', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('shipping_histories');
    }

    public function down()
    {
        $this->forge->dropTable('shipping_histories');
    }
}
