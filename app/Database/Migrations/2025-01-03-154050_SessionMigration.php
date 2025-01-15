<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SessionMigration extends Migration
{
    public function up()
    {
        $fields = [
            'session_token' => [
                'type' => 'VARCHAR',
                'constraint' => 32,
                'null' => true,
            ],
        ];
        $this->forge->addColumn('user_authentication', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('user_authentication', 'session_token');
    }
}
