<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSettingsTable extends Migration
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
            'site_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'logo' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'favicon' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'banner' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'qris_image' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('settings');

        // Insert default settings
        $data = [
            'site_name' => 'Duniaku Network',
            'logo' => 'https://images.pexels.com/photos/1181263/pexels-photo-1181263.jpeg',
            'favicon' => 'https://images.pexels.com/photos/1181263/pexels-photo-1181263.jpeg',
            'banner' => 'https://images.pexels.com/photos/442576/pexels-photo-442576.jpeg',
            'qris_image' => 'https://images.pexels.com/photos/6953876/pexels-photo-6953876.jpeg'
        ];

        $this->db->table('settings')->insert($data);
    }

    public function down()
    {
        $this->forge->dropTable('settings');
    }
}