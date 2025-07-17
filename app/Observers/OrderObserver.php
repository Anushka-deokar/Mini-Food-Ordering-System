<?php

namespace App\Observers;

use App\Models\Order;
use Illuminate\Support\Facades\Log;

class OrderObserver
{
    public function created(Order $order)
    {
        Log::info('📝 Order created: ' . $order->order_number . ' for user ID ' . $order->user_id);
    }
}
