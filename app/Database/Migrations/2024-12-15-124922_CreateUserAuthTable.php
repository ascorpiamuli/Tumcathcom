<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserAuthTable extends Migration
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
            'username' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null'           => false,
            ],
            'email' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null'           => false,
            ],
            'phone_number' => [
                'type'           => 'VARCHAR',
                'constraint'     => 15,
                'null'           => true,
            ],
            'password' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null'           => false,
            ],
            'ip_address' => [
                'type'           => 'VARCHAR',
                'constraint'     => 45,
                'null'           => true,
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

        $this->forge->addPrimaryKey('user_id');
        $this->forge->addKey('id', true);
        $this->forge->createTable('user_authentication', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('user_authentication', true);
    }
}
