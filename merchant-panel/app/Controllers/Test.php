<?php

namespace App\Controllers;

class Test extends BaseController
{
    public function index()
    {
        try {
            $db = \Config\Database::connect();
            $db->query("SELECT 1");
            return "CodeIgniter + Database connection SUCCESS";
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
}
// php spark serve
