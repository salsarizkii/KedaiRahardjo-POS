<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function index()
    {
        return view('customer.menus.index');
    }
}
