<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PaymentsTable extends Migration
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
            'proof' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'sender_bank' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'sender_account_number' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'sender_name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'merchant_bank' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('shipping_id', 'shippings', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('payments');
    }

    public function down()
    {
        $this->forge->createTable('payments');
    }
}
