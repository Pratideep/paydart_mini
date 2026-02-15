<?php

namespace App\Controllers;

use App\Models\PspKeyModel;
use Config\Services;

class Checkout extends BaseController
{
    public function index()
    {
        $merchantId = session()->get('merchant_id');
        if (!$merchantId) {
            return redirect()->to('/login');
        }

        $model = new PspKeyModel();
        $psps = $model
            ->where('merchant_id', $merchantId)
            ->where('status', 'active')
            ->orderBy('priority', 'ASC')
            ->findAll();

        return view('auth/checkout', [
            'merchant_id' => $merchantId,
            'psps' => $psps,
            'result' => session()->getFlashdata('checkout_result'),
            'error' => session()->getFlashdata('checkout_error'),
        ]);
    }

    public function pay()
    {
        $merchantId = session()->get('merchant_id');
        if (!$merchantId) {
            return redirect()->to('/login');
        }

        $orderId = trim((string) $this->request->getPost('order_id'));
        $amount = (float) $this->request->getPost('amount');
        $currency = strtoupper(trim((string) $this->request->getPost('currency')));
        $preferredPsp = strtolower(trim((string) $this->request->getPost('preferred_psp')));

        if ($orderId === '' || $amount <= 0 || $preferredPsp === '') {
            return redirect()->back()->withInput()->with('checkout_error', 'Please fill all required fields.');
        }

        $model = new PspKeyModel();
        $isAllowed = $model
            ->where('merchant_id', $merchantId)
            ->where('status', 'active')
            ->where('psp_name', $preferredPsp)
            ->countAllResults() > 0;

        if (!$isAllowed) {
            return redirect()->back()->withInput()->with('checkout_error', 'Selected PSP is not active for this merchant.');
        }

        $routerBaseUrl = rtrim((string) (getenv('PAYMENT_ROUTER_URL') ?: 'http://localhost:3000'), '/');

        try {
            $client = Services::curlrequest([
                'baseURI' => $routerBaseUrl,
                'http_errors' => false,
                'timeout' => 15,
            ]);

            $response = $client->post('/api/pay', [
                'json' => [
                    'merchant_id' => (int) $merchantId,
                    'order_id' => $orderId,
                    'amount' => $amount,
                    'currency' => $currency ?: 'INR',
                    'preferred_psp' => $preferredPsp,
                ],
            ]);

            $payload = json_decode((string) $response->getBody(), true);
            if (!is_array($payload)) {
                $payload = ['message' => 'Invalid response from payment router'];
            }

            if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
                return redirect()->to('/checkout')->with('checkout_result', $payload);
            }

            $errorMessage = $payload['message'] ?? 'Payment failed';
            if (!empty($payload['error'])) {
                $errorMessage .= ' | Details: ' . $payload['error'];
            }

            return redirect()->back()
                ->withInput()
                ->with('checkout_error', $errorMessage);
        } catch (\Throwable $e) {
            return redirect()->back()
                ->withInput()
                ->with('checkout_error', 'Could not connect to payment router: ' . $e->getMessage());
        }
    }
}
