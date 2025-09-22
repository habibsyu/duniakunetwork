<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['site_name', 'logo', 'favicon', 'banner', 'qris_image'];

    protected $validationRules = [
        'site_name' => 'required|max_length[100]',
    ];

    protected $skipValidation = false;

    public function getSettings()
    {
        return $this->first() ?? [];
    }
}