<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductMediasTable extends Migration
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
            'product_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'media' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'type' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('product_medias');
    }

    public function down()
    {
        $this->forge->dropTable('product_medias');
    }
}
