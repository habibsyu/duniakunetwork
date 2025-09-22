<?php

namespace App\Controllers;

use App\Models\ShopItemModel;
use App\Models\PaymentModel;
use App\Models\SettingModel;

class Shop extends BaseController
{
    protected $shopItemModel;
    protected $paymentModel;
    protected $settingModel;

    public function __construct()
    {
        $this->shopItemModel = new ShopItemModel();
        $this->paymentModel = new PaymentModel();
        $this->settingModel = new SettingModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Shop',
            'settings' => $this->settingModel->getSettings(),
            'shop_items' => $this->shopItemModel->findAll(),
        ];

        return view('shop/index', $data);
    }

    public function purchase($itemId)
    {
        $shopItem = $this->shopItemModel->find($itemId);
        
        if (!$shopItem) {
            session()->setFlashdata('error', 'Item not found');
            return redirect()->to('/shop');
        }

        if ($this->request->getMethod() === 'POST') {
            $file = $this->request->getFile('proof_image');
            
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('uploads/payment_proofs', $newName);

                $paymentData = [
                    'user_id' => session()->get('user_id'),
                    'shop_item_id' => $itemId,
                    'amount' => $shopItem['price'],
                    'proof_image' => $newName,
                    'status' => 'pending'
                ];

                if ($this->paymentModel->save($paymentData)) {
                    session()->setFlashdata('success', 'Payment proof uploaded successfully. Please wait for verification.');
                    return redirect()->to('/dashboard');
                } else {
                    session()->setFlashdata('error', 'Failed to save payment data');
                }
            } else {
                session()->setFlashdata('error', 'Please upload a valid payment proof image');
            }
        }

        $data = [
            'title' => 'Purchase - ' . $shopItem['item_name'],
            'settings' => $this->settingModel->getSettings(),
            'shop_item' => $shopItem,
        ];

        return view('shop/purchase', $data);
    }
}