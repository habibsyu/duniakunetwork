<?php

namespace App\Models;

use CodeIgniter\Model;

class ShopItemModel extends Model
{
    protected $table = 'shop_items';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['item_name', 'description', 'price', 'type'];

    protected $validationRules = [
        'item_name' => 'required|max_length[100]',
        'description' => 'required',
        'price' => 'required|decimal',
        'type' => 'required|in_list[money_coin,battle_pass,gacha_key]',
    ];

    protected $skipValidation = false;

    public function getItemsByType($type = null)
    {
        if ($type) {
            return $this->where('type', $type)->findAll();
        }
        return $this->findAll();
    }
}