<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PaymentModel;
use App\Models\ShopItemModel;
use App\Models\FeatureModel;
use App\Models\AdminStaffModel;
use App\Models\SettingModel;

class Admin extends BaseController
{
    protected $userModel;
    protected $paymentModel;
    protected $shopItemModel;
    protected $featureModel;
    protected $adminStaffModel;
    protected $settingModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->paymentModel = new PaymentModel();
        $this->shopItemModel = new ShopItemModel();
        $this->featureModel = new FeatureModel();
        $this->adminStaffModel = new AdminStaffModel();
        $this->settingModel = new SettingModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Admin Panel',
            'settings' => $this->settingModel->getSettings(),
            'pending_payments' => count($this->paymentModel->where('status', 'pending')->findAll()),
            'total_users' => count($this->userModel->findAll()),
        ];

        return view('admin/index', $data);
    }

    public function payments()
    {
        if ($this->request->getMethod() === 'POST') {
            $paymentId = $this->request->getPost('payment_id');
            $status = $this->request->getPost('status');
            
            $this->paymentModel->update($paymentId, ['status' => $status]);
            session()->setFlashdata('success', 'Payment status updated successfully');
        }

        $data = [
            'title' => 'Manage Payments',
            'settings' => $this->settingModel->getSettings(),
            'payments' => $this->paymentModel->getPaymentsWithDetails(),
        ];

        return view('admin/payments', $data);
    }

    public function shop_items()
    {
        if ($this->request->getMethod() === 'POST') {
            $action = $this->request->getPost('action');
            
            if ($action === 'create') {
                $data = [
                    'item_name' => $this->request->getPost('item_name'),
                    'description' => $this->request->getPost('description'),
                    'price' => $this->request->getPost('price'),
                    'type' => $this->request->getPost('type'),
                ];
                
                if ($this->shopItemModel->save($data)) {
                    session()->setFlashdata('success', 'Shop item created successfully');
                }
            } elseif ($action === 'update') {
                $id = $this->request->getPost('id');
                $data = [
                    'item_name' => $this->request->getPost('item_name'),
                    'description' => $this->request->getPost('description'),
                    'price' => $this->request->getPost('price'),
                    'type' => $this->request->getPost('type'),
                ];
                
                if ($this->shopItemModel->update($id, $data)) {
                    session()->setFlashdata('success', 'Shop item updated successfully');
                }
            } elseif ($action === 'delete') {
                $id = $this->request->getPost('id');
                if ($this->shopItemModel->delete($id)) {
                    session()->setFlashdata('success', 'Shop item deleted successfully');
                }
            }
        }

        $data = [
            'title' => 'Manage Shop Items',
            'settings' => $this->settingModel->getSettings(),
            'shop_items' => $this->shopItemModel->findAll(),
        ];

        return view('admin/shop_items', $data);
    }

    public function settings()
    {
        if ($this->request->getMethod() === 'POST') {
            $data = [
                'site_name' => $this->request->getPost('site_name'),
                'logo' => $this->request->getPost('logo'),
                'favicon' => $this->request->getPost('favicon'),
                'banner' => $this->request->getPost('banner'),
                'qris_image' => $this->request->getPost('qris_image'),
            ];
            
            $settings = $this->settingModel->first();
            if ($settings) {
                $this->settingModel->update($settings['id'], $data);
            } else {
                $this->settingModel->save($data);
            }
            
            session()->setFlashdata('success', 'Settings updated successfully');
        }

        $data = [
            'title' => 'Website Settings',
            'settings' => $this->settingModel->getSettings(),
        ];

        return view('admin/settings', $data);
    }

    public function features()
    {
        if ($this->request->getMethod() === 'POST') {
            $action = $this->request->getPost('action');
            
            if ($action === 'create') {
                $data = [
                    'title' => $this->request->getPost('title'),
                    'description' => $this->request->getPost('description'),
                    'image' => $this->request->getPost('image'),
                ];
                
                if ($this->featureModel->save($data)) {
                    session()->setFlashdata('success', 'Feature created successfully');
                }
            } elseif ($action === 'update') {
                $id = $this->request->getPost('id');
                $data = [
                    'title' => $this->request->getPost('title'),
                    'description' => $this->request->getPost('description'),
                    'image' => $this->request->getPost('image'),
                ];
                
                if ($this->featureModel->update($id, $data)) {
                    session()->setFlashdata('success', 'Feature updated successfully');
                }
            } elseif ($action === 'delete') {
                $id = $this->request->getPost('id');
                if ($this->featureModel->delete($id)) {
                    session()->setFlashdata('success', 'Feature deleted successfully');
                }
            }
        }

        $data = [
            'title' => 'Manage Features',
            'settings' => $this->settingModel->getSettings(),
            'features' => $this->featureModel->findAll(),
        ];

        return view('admin/features', $data);
    }

    public function staff()
    {
        if ($this->request->getMethod() === 'POST') {
            $action = $this->request->getPost('action');
            
            if ($action === 'create') {
                $data = [
                    'name' => $this->request->getPost('name'),
                    'position' => $this->request->getPost('position'),
                    'contact' => $this->request->getPost('contact'),
                ];
                
                if ($this->adminStaffModel->save($data)) {
                    session()->setFlashdata('success', 'Staff member created successfully');
                }
            } elseif ($action === 'update') {
                $id = $this->request->getPost('id');
                $data = [
                    'name' => $this->request->getPost('name'),
                    'position' => $this->request->getPost('position'),
                    'contact' => $this->request->getPost('contact'),
                ];
                
                if ($this->adminStaffModel->update($id, $data)) {
                    session()->setFlashdata('success', 'Staff member updated successfully');
                }
            } elseif ($action === 'delete') {
                $id = $this->request->getPost('id');
                if ($this->adminStaffModel->delete($id)) {
                    session()->setFlashdata('success', 'Staff member deleted successfully');
                }
            }
        }

        $data = [
            'title' => 'Manage Staff',
            'settings' => $this->settingModel->getSettings(),
            'staff' => $this->adminStaffModel->findAll(),
        ];

        return view('admin/staff', $data);
    }
}