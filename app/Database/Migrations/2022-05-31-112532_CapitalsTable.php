<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CapitalsTable extends Migration
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
            'publish_date' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('capitals');
    }

    public function down()
    {
        $this->forge->dropTable('capitals');
    }
}
