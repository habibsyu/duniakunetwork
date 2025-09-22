<?php

namespace App\Models;

use CodeIgniter\Model;

class FeatureModel extends Model
{
    protected $table = 'features';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['title', 'description', 'image'];

    protected $validationRules = [
        'title' => 'required|max_length[100]',
        'description' => 'required',
        'image' => 'required|max_length[255]',
    ];

    protected $skipValidation = false;
}