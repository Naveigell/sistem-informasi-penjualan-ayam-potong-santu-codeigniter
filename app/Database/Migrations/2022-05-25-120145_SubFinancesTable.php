<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SubFinancesTable extends Migration
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
            'finance_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'value' => [
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('finance_id', 'finances', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('sub_finances');
    }

    public function down()
    {
        $this->forge->dropTable('sub_finances');
    }
}
