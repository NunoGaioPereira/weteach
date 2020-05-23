<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillingController extends Controller
{
    // Billing
    public function billing (Request $request)
    {
        return view('settings.billing');
    }

    public function billing_save (Request $request)
    {
        echo 'Succesfully saved your billing info.';
    }
}
