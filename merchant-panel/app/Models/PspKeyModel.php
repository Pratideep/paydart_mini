<?php
namespace App\Models;
use CodeIgniter\Model;


class PspKeyModel extends Model{
    protected $primaryKey = 'id';
    protected $table = "merchant_psp_keys";

    protected $allowedFields = [
        'merchant_id',
        'psp_name',
        'api_key',
        'api_secret',
        'priority',
        'status'
    ];
}

