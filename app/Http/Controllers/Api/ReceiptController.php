<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    public function schoolActivityReceipt(){
        return view('receipt.school-activity-receipt');
    }

    public function monthlyFormationReceipt(){
        return view('receipt.monthly-formation-receipt');
    }

    public function meritReceipt(){
        return view('receipt.meiret-receipt');
    }

    public function demeritReceipt(){
        return view('receipt.demerit-receipt');
    }
}
