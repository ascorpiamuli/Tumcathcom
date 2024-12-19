<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSaintsTable extends Migration
{
    public function up()
    {
        // Define the fields for the saints table
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'saint_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'feast_day' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'patron' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'birth' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'death' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'saint_image' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'paragraphs' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'youtube_links' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type'           => 'TIMESTAMP',
                'null'           => true,
            ],
            'updated_at' => [
                'type'           => 'TIMESTAMP',
                'null'           => true,
                'on_update'      => 'CURRENT_TIMESTAMP',
            ],
        ]);

        // Add a primary key
        $this->forge->addKey('id', true);

        // Create the table
        $this->forge->createTable('saints');
    }

    public function down()
    {
        // Drop the saints table
        $this->forge->dropTable('saints');
    }
}
