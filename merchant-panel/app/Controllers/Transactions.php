<?php

namespace App\Controllers;

use Config\Database;

class Transactions extends BaseController
{
    public function index()
    {
        $merchantId = session()->get('merchant_id');
        if (!$merchantId) {
            return redirect()->to('/login');
        }

        $db = Database::connect();
        if (!$db->tableExists('transactions')) {
            return view('auth/transactions', [
                'merchant_id' => $merchantId,
                'transactions' => [],
                'error' => 'Transactions table not found.',
            ]);
        }

        $fields = $db->getFieldNames('transactions');
        $pspField = in_array('psp_used', $fields, true)
            ? 'psp_used'
            : (in_array('psp_name', $fields, true) ? 'psp_name' : null);
        $createdField = in_array('created_at', $fields, true)
            ? 'created_at'
            : (in_array('updated_at', $fields, true) ? 'updated_at' : null);

        $select = ['id', 'order_id', 'amount', 'status'];
        if ($pspField !== null) {
            $select[] = "{$pspField} AS psp";
        }
        if ($createdField !== null) {
            $select[] = $createdField;
        }

        $builder = $db->table('transactions')
            ->select(implode(', ', $select))
            ->where('merchant_id', (int) $merchantId);

        if ($createdField !== null) {
            $builder->orderBy($createdField, 'DESC');
        } else {
            $builder->orderBy('id', 'DESC');
        }

        $transactions = $builder->get()->getResultArray();

        return view('auth/transactions', [
            'merchant_id' => $merchantId,
            'transactions' => $transactions,
            'error' => null,
        ]);
    }
}
