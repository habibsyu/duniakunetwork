<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFeaturesTable extends Migration
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
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'description' => [
                'type' => 'TEXT',
            ],
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('features');

        // Insert sample features
        $data = [
            [
                'title' => 'Custom Survival',
                'description' => 'Experience unique survival gameplay with custom mechanics and features.',
                'image' => 'https://images.pexels.com/photos/1029604/pexels-photo-1029604.jpeg'
            ],
            [
                'title' => 'PvP Arena',
                'description' => 'Battle against other players in our competitive PvP arenas.',
                'image' => 'https://images.pexels.com/photos/442576/pexels-photo-442576.jpeg'
            ],
            [
                'title' => 'Economy System',
                'description' => 'Trade, buy and sell items with our comprehensive economy system.',
                'image' => 'https://images.pexels.com/photos/164527/pexels-photo-164527.jpeg'
            ],
        ];

        $this->db->table('features')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('features');
    }
}