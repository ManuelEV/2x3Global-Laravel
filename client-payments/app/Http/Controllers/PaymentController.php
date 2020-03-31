<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;

class PaymentController extends Controller
{
    public function store(Request $request)
    {

        $payment = new Payment();
        $payment->uuid = $request->uuid;
        $payment->payment_date = $request->payment_date;
        $payment->expires_at = $request->expires_at;
        $payment->status = $request->status;
        $payment->user_id = $request->user_id;
        $payment->clp_usd = $request->clp_usd;

        $payment->save();

    }

    public function list(Request $request)
    {

        $payments = Payment::select('uuid', 'payment_date', 'expires_at', 'status', 'user_id', 'clp_usd')
        ->where('user_id', '=', $request->client)
        ->orderBy('uuid', 'desc')
        ->get();


        return [
            'payments' => $payments
        ];
    }
}
