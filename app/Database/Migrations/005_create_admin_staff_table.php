<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAdminStaffTable extends Migration
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
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'position' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'contact' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('admin_staff');

        // Insert sample admin staff
        $data = [
            ['name' => 'John Doe', 'position' => 'Administrator', 'contact' => 'admin@duniaku.net'],
            ['name' => 'Jane Smith', 'position' => 'Moderator', 'contact' => 'jane@duniaku.net'],
        ];

        $this->db->table('admin_staff')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('admin_staff');
    }
}