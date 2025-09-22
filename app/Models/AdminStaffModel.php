<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminStaffModel extends Model
{
    protected $table = 'admin_staff';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['name', 'position', 'contact'];

    protected $validationRules = [
        'name' => 'required|max_length[100]',
        'position' => 'required|max_length[50]',
        'contact' => 'required|max_length[100]',
    ];

    protected $skipValidation = false;
}