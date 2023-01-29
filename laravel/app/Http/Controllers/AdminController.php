<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    public function index()
    {
        return view('admin.index');
    }

    public function newMeter()
    {
        return view('admin.forms.new.meter');
    }

    public function meterIndex()
    {
        return view('admin.meter.index');
    }

    public function customerView($customer_id)
    {
        return view('admin.customer.view', [
            'customer' => \App\Models\User::find($customer_id),
        ]);
    }

}