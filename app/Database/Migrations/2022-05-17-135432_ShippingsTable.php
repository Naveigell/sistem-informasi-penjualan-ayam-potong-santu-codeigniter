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
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id');
        $this->forge->addForeignKey('area_id', 'shipping_costs', 'id');
        $this->forge->createTable('shippings');
    }

    public function down()
    {
        $this->forge->dropTable('shippings');
    }
}
