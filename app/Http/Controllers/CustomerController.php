<?php

namespace App\Http\Controllers;

use App\User;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::customer()->latest()->paginate(10);
        return view('backend.customer.index', compact('customers'));
    }

    public function show(User $customer)
    {
        $customer->load(['wishlist', 'viewed_products']);
        $wishlist = $customer->wishlist;
        $viewed_products = $customer->viewed_products;
        return view('backend.customer.show', compact('customer', 'wishlist', 'viewed_products'));
    }
}
