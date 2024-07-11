<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

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
        
        $order = $request->all();
        $product = Product::find($request->product_id);
        $order['product_id']=$product->id;
        $order['price']=$product->price;
        $order['user_id']=Auth::user()->id;
        Order::create($order);
        return redirect()->back()->with('success', 'Order created successfully!');
    }
    
}
