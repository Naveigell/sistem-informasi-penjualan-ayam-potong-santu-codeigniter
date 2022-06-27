<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddHasReadInShippingsTable extends Migration
{
    public function up()
    {
        $fields = [
            'has_read' => [
                'type' => 'INTEGER',
                'unsigned' => true,
                'default' => 0,
            ]
        ];

        $this->forge->addColumn('shippings', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('shippings', 'has_read');
    }
}
