<?php

namespace App\Console\Commands;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;

class OrderApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $orders = Order::where('api_status', 2)->get();
        // Log::info('First order ID: ' . $orders->first()->id);


        foreach ($orders as $o) {
            try {
                $url = 'http://127.0.0.1:8001/api/order_customers';
                $data = [
                    'voen' => $o->voen,
                    'fullname' => $o->full_name,
                    'phone' => $o->phone,
                    'email' => $o->email,
                    'object_name' => $o->object_name,
                    'object_code' => $o->object_code,
                ];
        
                $ch = curl_init();
        
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
                $response = curl_exec($ch);
        
                if (curl_errno($ch)) {
                    throw new \Exception('CURL Error: ' . curl_error($ch));
                }
        
                curl_close($ch);
        
                $order_customer = json_decode($response);
                if (!$order_customer || !isset($order_customer->order_customer->id)) {
                    throw new \Exception('Failed to create order customer');
                }
                $id = $order_customer->order_customer->id;
        
                $url = 'http://127.0.0.1:8001/api/orders';
        
                $data = [
                    'order_customer_id' => $id,
                    'vendor_id' => $o->id,
                    'product_id' => $o->product_id,
                    'price' => $o->price,
                    'quantity' => $o->qty,
                    'comment' => $o->comment,
                    'status' => 1,
                    'creator_id' => $o->user_id,
                ];
        
                $ch = curl_init();
        
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
                $response = curl_exec($ch);
        
                if (curl_errno($ch)) {
                    throw new \Exception('CURL Error: ' . curl_error($ch));
                }
        
                curl_close($ch);
        
                $o->api_status = 1;
                $o->api_status_message = 'Order sent successfully';
                $o->save();
            } catch (\Exception $e) {
                $o->api_status_message = $e->getMessage();
                $o->save();
            }
        }
    }
}
