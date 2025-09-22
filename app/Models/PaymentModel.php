<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['user_id', 'shop_item_id', 'amount', 'status', 'proof_image'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = null;

    protected $validationRules = [
        'user_id' => 'required|integer',
        'shop_item_id' => 'required|integer',
        'amount' => 'required|decimal',
        'proof_image' => 'required',
    ];

    protected $skipValidation = false;

    public function getPaymentsWithDetails($userId = null)
    {
        $query = $this->select('payments.*, users.username_in_game, shop_items.item_name')
                     ->join('users', 'users.id = payments.user_id')
                     ->join('shop_items', 'shop_items.id = payments.shop_item_id')
                     ->orderBy('payments.created_at', 'DESC');
        
        if ($userId) {
            $query->where('payments.user_id', $userId);
        }
        
        return $query->findAll();
    }

    public function getPendingPayments()
    {
        return $this->getPaymentsWithDetails()
                   ->where('payments.status', 'pending')
                   ->findAll();
    }
}