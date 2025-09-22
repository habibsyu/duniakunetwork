<?php

namespace App\Controllers;

use App\Models\FeatureModel;
use App\Models\SettingModel;
use App\Models\AdminStaffModel;

class Home extends BaseController
{
    protected $featureModel;
    protected $settingModel;
    protected $adminStaffModel;

    public function __construct()
    {
        $this->featureModel = new FeatureModel();
        $this->settingModel = new SettingModel();
        $this->adminStaffModel = new AdminStaffModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Welcome to Duniaku Network',
            'settings' => $this->settingModel->getSettings(),
            'features' => $this->featureModel->findAll(),
        ];

        return view('home/index', $data);
    }

    public function features()
    {
        $data = [
            'title' => 'Server Features',
            'settings' => $this->settingModel->getSettings(),
            'features' => $this->featureModel->findAll(),
        ];

        return view('home/features', $data);
    }

    public function admin_info()
    {
        $data = [
            'title' => 'Admin & Staff',
            'settings' => $this->settingModel->getSettings(),
            'admin_staff' => $this->adminStaffModel->findAll(),
        ];

        return view('home/admin_info', $data);
    }

    public function community()
    {
        $data = [
            'title' => 'Community',
            'settings' => $this->settingModel->getSettings(),
        ];

        return view('home/community', $data);
    }
}