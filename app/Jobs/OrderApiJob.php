<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class OrderApiJob implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
    protected function schedule(Schedule $schedule)
    {
        $orders = Order::where('api_status', 2)->get();
        Log::info('First order ID: ' . $orders->first()->id);


        foreach ($orders as $o) {
            try {
                $url = 'http://127.0.0.1:5555/api/order_customers';
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
        
                $url = 'http://127.0.0.1:5555/api/orders';
        
                $data = [
                    'order_customer_id' => $id,
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