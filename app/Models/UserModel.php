<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['username_in_game', 'password', 'email', 'role_id'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'username_in_game' => 'required|max_length[50]|is_unique[users.username_in_game]',
        'password' => 'required|min_length[8]',
        'email' => 'permit_empty|valid_email|max_length[100]',
    ];

    protected $validationMessages = [
        'username_in_game' => [
            'required' => 'Username in game is required',
            'is_unique' => 'Username in game already exists',
        ],
        'password' => [
            'required' => 'Password is required',
            'min_length' => 'Password must be at least 8 characters long',
        ],
    ];

    protected $skipValidation = false;

    public function getUserWithRole($id)
    {
        return $this->select('users.*, roles.role_name, roles.priority')
                   ->join('roles', 'roles.id = users.role_id')
                   ->where('users.id', $id)
                   ->first();
    }

    public function getUserPermissions($userId)
    {
        return $this->db->table('users')
                       ->select('permissions.permission_name')
                       ->join('roles', 'roles.id = users.role_id')
                       ->join('role_permissions', 'role_permissions.role_id = roles.id')
                       ->join('permissions', 'permissions.id = role_permissions.permission_id')
                       ->where('users.id', $userId)
                       ->get()
                       ->getResultArray();
    }

    public function verifyUser($username, $password)
    {
        $user = $this->where('username_in_game', $username)->first();
        
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        
        return false;
    }
}