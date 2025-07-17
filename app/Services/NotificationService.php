<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlacedMail;
use App\Models\Order;

class NotificationService
{
    public function notifyAdmin(Order $order)
    {
        Mail::to(config('settings.admin_email'))->send(new OrderPlacedMail($order));
        \Log::info('🔔 Admin notified via NotificationService.');
    }
}
