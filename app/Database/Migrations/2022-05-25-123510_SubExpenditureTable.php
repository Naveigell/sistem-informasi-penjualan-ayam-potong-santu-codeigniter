<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SubExpenditureTable extends Migration
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
            'expenditure_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
            ],
            'nominal' => [
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
        $this->forge->addForeignKey('expenditure_id', 'expenditures', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('sub_expenditures');
    }

    public function down()
    {
        $this->forge->dropTable('sub_expenditures');
    }
}
