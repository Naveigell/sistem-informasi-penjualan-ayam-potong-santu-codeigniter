<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ShippingsTable extends Migration
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
            'area_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'order_id' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'total' => [
                'type' => 'INTEGER',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'weight' => [
                'type' => 'INTEGER',
                'constraint' => 10,
                'unsigned' => true,
            ],
            'payment_option' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'finished' => [
                'type' => 'INT',
                'constraint' => 2,
                'unsigned' => true,
            ],
            'finished_date' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('area_id', 'shipping_costs', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('shippings');
    }

    public function down()
    {
        $this->forge->dropTable('shippings');
    }
}
