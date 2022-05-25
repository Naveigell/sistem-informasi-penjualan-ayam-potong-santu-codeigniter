<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ExpenditureTable extends Migration
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
            'total' => [
                'type' => 'INT',
                'constraint' => 20,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('expenditures');
    }

    public function down()
    {
        $this->forge->dropTable('expenditures');
    }
}
