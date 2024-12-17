<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserProfilesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'           => 'VARCHAR',
                'constraint'     => 32,
                'null'           => false,
            ],
            'first_name' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null'           => true,
            ],
            'last_name' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null'           => true,
            ],
            'registration_number' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null'           => true,
            ],
            'dob' => [
                'type'           => 'DATE',
                'null'           => true,
            ],
            'year_of_study' => [
                'type'           => 'INT',
                'null'           => true,
            ],
            'family_jumuia' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null'           => true,
            ],
            'course' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null'           => true,
            ],
            'baptized' => [
                'type'           => 'BOOLEAN',
                'default'        => 0,
                'null'           => false,
            ],
            'confirmed' => [
                'type'           => 'BOOLEAN',
                'default'        => 0,
                'null'           => false,
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

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('user_profiles', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('user_profiles', true);
    }
}
