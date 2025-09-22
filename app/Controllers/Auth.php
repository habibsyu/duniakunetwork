<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        if ($this->request->getMethod() === 'POST') {
            $username = $this->request->getPost('username_in_game');
            $password = $this->request->getPost('password');

            $user = $this->userModel->verifyUser($username, $password);

            if ($user) {
                $session = session();
                $session->set([
                    'user_id' => $user['id'],
                    'username_in_game' => $user['username_in_game'],
                    'role_id' => $user['role_id'],
                    'is_logged_in' => true
                ]);

                // Check if user is admin
                if ($user['role_id'] <= 2) {
                    return redirect()->to('/admin');
                }

                return redirect()->to('/dashboard');
            } else {
                session()->setFlashdata('error', 'Invalid credentials');
            }
        }

        $data = [
            'title' => 'Login',
            'settings' => (new \App\Models\SettingModel())->getSettings(),
        ];

        return view('auth/login', $data);
    }

    public function register()
    {
        if ($this->request->getMethod() === 'POST') {
            $data = [
                'username_in_game' => $this->request->getPost('username_in_game'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'email' => $this->request->getPost('email'),
                'role_id' => 5 // Default to User role
            ];

            if ($this->userModel->save($data)) {
                session()->setFlashdata('success', 'Registration successful! Please login.');
                return redirect()->to('/auth/login');
            } else {
                session()->setFlashdata('errors', $this->userModel->errors());
            }
        }

        $data = [
            'title' => 'Register',
            'settings' => (new \App\Models\SettingModel())->getSettings(),
        ];

        return view('auth/register', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}