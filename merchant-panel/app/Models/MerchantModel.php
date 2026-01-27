<?php

namespace App\Models;

use CodeIgniter\Model;

class MerchantModel extends Model
{
    protected $table = 'merchants';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'email',
        'password'
    ];
}
