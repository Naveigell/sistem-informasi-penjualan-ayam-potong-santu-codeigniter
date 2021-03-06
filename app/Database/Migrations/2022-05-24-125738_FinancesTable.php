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
            'rand_id' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'publish_date' => [
                'type' => 'TIMESTAMP',
            ],
            'finance_type' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
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
