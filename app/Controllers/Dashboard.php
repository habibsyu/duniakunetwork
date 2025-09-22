<?php

namespace App\Controllers;

use App\Models\PaymentModel;
use App\Models\SettingModel;

class Dashboard extends BaseController
{
    protected $paymentModel;
    protected $settingModel;

    public function __construct()
    {
        $this->paymentModel = new PaymentModel();
        $this->settingModel = new SettingModel();
    }

    public function index()
    {
        $userId = session()->get('user_id');
        
        $data = [
            'title' => 'Dashboard',
            'settings' => $this->settingModel->getSettings(),
            'payments' => $this->paymentModel->getPaymentsWithDetails($userId),
        ];

        return view('dashboard/index', $data);
    }
}