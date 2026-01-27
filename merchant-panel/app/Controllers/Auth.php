<?php

namespace App\Controllers;

use App\Models\MerchantModel;

class Auth extends BaseController
{
    public function register()
    {
        // Check if it's a POST request
        if ($this->request->is('post')) {

            $model = new MerchantModel();

            $data = [
                'name'     => $this->request->getPost('name'),
                'email'    => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            ];

            // Insert and check for success
            if ($model->insert($data)) {
                return redirect()->to(base_url('login'))->with('success', 'Registration successful!');
            } else {
                // If database fails, show why
                dd($model->errors());
            }
        }

        // If it's a GET request (or the IF fails), show the form
        return view('auth/register');
    }

    public function login()
    {
        // Use the reliable CI4 helper
        if ($this->request->is('post')) {

            $model = new MerchantModel();
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            // Find the merchant by email
            $merchant = $model->where('email', $email)->first();

            // Verify merchant exists and password is correct
            if ($merchant && password_verify($password, $merchant['password'])) {
                $session = session();

                // Set session data
                $session->set([
                    'merchant_id'   => $merchant['id'],
                    'merchant_name' => $merchant['name'], // Storing name for the UI
                    'isLoggedIn'    => true
                ]);

                return redirect()->to(base_url('dashboard'));
            }

            // If login fails, go back with an error message
            return redirect()->back()->with('error', 'Invalid email or password');
        }

        // Show the login view for GET requests
        return view('auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
