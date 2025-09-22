<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePermissionsTable extends Migration
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
            'permission_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('permissions');

        // Insert default permissions
        $permissions = [
            'manage_users', 'manage_settings', 'manage_shop', 'approve_payment',
            'edit_features', 'edit_staff', 'view_users', 'view_payments',
            'view_shop', 'upload_payment_proof'
        ];

        foreach ($permissions as $permission) {
            $this->db->table('permissions')->insert(['permission_name' => $permission]);
        }
    }

    public function down()
    {
        $this->forge->dropTable('permissions');
    }
}