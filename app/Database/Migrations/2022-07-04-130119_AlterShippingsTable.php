<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterShippingsTable extends Migration
{
    public function up()
    {
        $fields = [
            'user_has_read' => [
                'type' => 'INTEGER',
                'unsigned' => true,
                'default' => 0,
            ]
        ];

        $this->forge->addColumn('shippings', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('shippings', 'user_has_read');
    }
}
