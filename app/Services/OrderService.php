<?php
namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Food;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Jobs\SendOrderNotification;

class OrderService
{
    public function createOrder(array $data, $userId)
    {
        return DB::transaction(function () use ($data, $userId) {
            $total = 0;
            $itemsData = [];

            foreach ($data['items'] as $item) {
                $food = Food::findOrFail($item['food_id']);
                if (!$food->is_available) {
                    throw new \Exception("Food item not available");
                }

                $subtotal = $food->price * $item['quantity'];
                $total += $subtotal;
                $itemsData[] = [
                    'food_id' => $food->id,
                    'quantity' => $item['quantity'],
                    'price_per_item' => $food->price,
                    'subtotal' => $subtotal
                ];
            }

            $order = Order::create([
                'user_id' => $userId,
                'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                'total_amount' => $total,
                'status' => 'pending',
            ]);
            SendOrderNotification::dispatch($order);

            foreach ($itemsData as $item) {
                $order->items()->create($item);
            }

            return $order->load('items.food');
        });
    }

    public function getUserOrders(int $userId, $status = null)
    {
        $query = Order::with('items.food')->where('user_id', $userId);
        if ($status) {
            $query->where('status', $status);
        }
        return $query->orderBy('created_at', 'desc')->get();
    }

    private function generateOrderNumber(): string
    {
        return 'ORD-' . strtoupper(Str::random(8));
    }
}