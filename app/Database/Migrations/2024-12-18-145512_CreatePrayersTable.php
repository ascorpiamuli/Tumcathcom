<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePrayersTable extends Migration
{
    public function up()
    {
        // Create 'prayers' table
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'      => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'content' => [
                'type' => 'TEXT',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('prayers');
    }

    public function down()
    {
        // Drop the 'prayers' table
        $this->forge->dropTable('prayers');
    }
}
