<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateShopItemsTable extends Migration
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
            'item_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'description' => [
                'type' => 'TEXT',
            ],
            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'type' => [
                'type'       => 'ENUM',
                'constraint' => ['money_coin', 'battle_pass', 'gacha_key'],
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('shop_items');

        // Insert sample shop items
        $data = [
            ['item_name' => '1000 Money Coins', 'description' => 'Get 1000 in-game money coins', 'price' => 10000.00, 'type' => 'money_coin'],
            ['item_name' => 'Premium Battle Pass', 'description' => 'Unlock premium battle pass rewards', 'price' => 50000.00, 'type' => 'battle_pass'],
            ['item_name' => '5x Gacha Keys', 'description' => 'Get 5 gacha keys to unlock rare items', 'price' => 25000.00, 'type' => 'gacha_key'],
        ];

        $this->db->table('shop_items')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('shop_items');
    }
}