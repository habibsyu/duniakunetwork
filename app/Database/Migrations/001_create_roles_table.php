<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRolesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'role_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'priority' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('roles');

        // Insert default roles
        $data = [
            ['role_name' => 'Admin', 'priority' => 1, 'description' => 'Full system access'],
            ['role_name' => 'Admin Staff', 'priority' => 2, 'description' => 'Staff management access'],
            ['role_name' => 'Moderator', 'priority' => 3, 'description' => 'Moderation access'],
            ['role_name' => 'Helper', 'priority' => 4, 'description' => 'Helper access'],
            ['role_name' => 'User', 'priority' => 5, 'description' => 'Standard user access'],
        ];

        $this->db->table('roles')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('roles');
    }
}