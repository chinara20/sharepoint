<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('pages.orders.index', compact('orders'));
    }
    public function create()
    {
        $products = Product::all();
        return view('pages.orders.create',compact('products'));
    }

    public function store(Request $request)
    {
        // $this->validate([
        //     'company_name' => 'nullable|string',
        //     'voen' => 'nullable|string',
        //     'full_name' => 'nullable|string',
        //     'phone' => 'nullable|string',
        //     'email' => 'nullable|email',
        //     'object_name' => 'nullable|string',
        //     'product_id' => 'nullable|integer',
        //     'price' => 'nullable|numeric',
        //     'qty' => 'nullable|integer',
        //     'comment' => 'nullable|string',
        //     'status' => 'nullable|in:pending,processing,completed',
        // ]);

        $order = Order::create($request->all());

        return redirect()->back()->with('success', 'Order created successfully!');
    }
}
