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

    public function update(Request $request, $id)
    {
         $order_req = $request->all();
         

        $order = Order::find($id);

        $order->update($order_req);

        try {
           $updatedOrder = $this->updateOrderStatus($order->id, $order->status);
        } catch (\Exception $e) {
           return response()->json(['message' => 'Error updating order status in SharePoint: ' . $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Order updated successfully', 'order' => $updatedOrder], 200);
    }
    public function updateOrderStatus($id)
    {
        $orderId = $id;

        $status = request()->input('status');

       $o =  Order::where('id',$orderId)->first();
       if($o){
        $o->status = $status;
        $o->save();
        return 'order deyishdi';
       }else{
        return 'order tapilmadi';
       }

       
    }
    
    
}


 // Sonra API ile iletişim kuracağımız URL
        // $url = 'http://127.0.0.1:8000/api/update-order-status';

        // // API'ye göndereceğimiz veri
        // $data = [
        //     'order_id' => $orderId,
        //     'status' => $status,
        // ];

        // // CURL işlemleri başlatılıyor
        // $ch = curl_init();

        // // CURL ayarları
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // // CURL işlemini gerçekleştir ve yanıtı al
        // $response = curl_exec($ch);

        // // CURL işlemi sırasında hata olup olmadığını kontrol et
        // if (curl_errno($ch)) {
        //     throw new \Exception('CURL Error: ' . curl_error($ch));
        // }

        // // CURL işlemi tamamlandı, kapat
        // curl_close($ch);

        // // Yanıtı JSON olarak decode et
        // $order = json_decode($response);

        // // JSON yanıtını döndür
        // return $order;