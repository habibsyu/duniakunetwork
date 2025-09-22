<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRolePermissionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'role_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'permission_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
        ]);

        $this->forge->addForeignKey('role_id', 'roles', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('permission_id', 'permissions', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('role_permissions');

        // Assign default permissions to roles
        $defaultPermissions = [
            1 => [1, 2, 3, 4, 5, 6, 7, 8], // Admin - all permissions except user-specific
            2 => [3, 4, 5, 7, 8], // Admin Staff
            3 => [4, 7, 8], // Moderator
            4 => [7, 8], // Helper
            5 => [9, 10], // User
        ];

        foreach ($defaultPermissions as $roleId => $permissions) {
            foreach ($permissions as $permissionId) {
                $this->db->table('role_permissions')->insert([
                    'role_id' => $roleId,
                    'permission_id' => $permissionId
                ]);
            }
        }
    }

    public function down()
    {
        $this->forge->dropTable('role_permissions');
    }
}