<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['role_name', 'priority', 'description'];

    protected $validationRules = [
        'role_name' => 'required|max_length[50]',
        'priority' => 'required|integer',
    ];

    protected $skipValidation = false;

    public function getRolesWithPermissions()
    {
        return $this->select('roles.*, GROUP_CONCAT(permissions.permission_name) as permissions')
                   ->join('role_permissions', 'role_permissions.role_id = roles.id', 'left')
                   ->join('permissions', 'permissions.id = role_permissions.permission_id', 'left')
                   ->groupBy('roles.id')
                   ->orderBy('priority', 'ASC')
                   ->findAll();
    }
}