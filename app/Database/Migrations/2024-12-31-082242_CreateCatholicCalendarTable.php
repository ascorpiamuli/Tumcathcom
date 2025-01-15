<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCatholicCalendarTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'unsigned'      => true,
                'auto_increment' => true,
            ],
            'summary'     => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'start'       => [
                'type'           => 'DATETIME',
            ],
            'end'         => [
                'type'           => 'DATETIME',
            ],
            'description' => [
                'type'           => 'TEXT',
            ],
            'created_at'  => [
                'type'           => 'DATETIME',
                'null'           => false,
                'default'        => null, // No default value here
            ],
            'updated_at'  => [
                'type'           => 'DATETIME',
                'null'           => false,
                'default'        => null, // No default value here
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('catholic_calendar');
    }

    public function down()
    {
        $this->forge->dropTable('catholic_calendar');
    }
}
