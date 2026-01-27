<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $merchantId = session()->get('merchant_id');

        if (!$merchantId) {
            return redirect()->to('/login');
        }

        return view('auth/dashboard', [
            'merchant_id' => $merchantId
        ]);
    }
}

