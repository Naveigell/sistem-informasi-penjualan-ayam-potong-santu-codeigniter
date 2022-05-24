<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FinancesTable extends Migration
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
            'value' => [
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'type' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('finances');
    }

    public function down()
    {
        $this->forge->dropTable('finances');
    }
}
