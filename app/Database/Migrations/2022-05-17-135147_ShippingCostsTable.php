<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ShippingCostsTable extends Migration
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
            'area' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'cost' => [
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('shipping_costs');
    }

    public function down()
    {
        $this->forge->dropTable('shipping_costs');
    }
}
