<?php

namespace App\Http\Controllers;

use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('user')->latest()->get();
        return view('transactions', compact('payments'));
    }

    public function destroy($id)
    {
        Payment::destroy($id);
        return back();
    }
}
