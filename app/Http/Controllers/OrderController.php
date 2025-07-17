<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlacedMail;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.food_id' => 'required|exists:foods,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            $order = $this->orderService->createOrder($request->all(), Auth::id());
            $order->load('items.food');

            // Email to admin
            Mail::to(config('settings.admin_email'))->send(new OrderPlacedMail($order));
            \Log::info('Mail sending executed.');

            DB::commit();

            return redirect()->route('dashboard')->with('success', 'Thank You !!! Your order has been placed successfully!  Please pay bill at Counter');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to place order: ' . $e->getMessage()]);

        }
    }


    public function index(Request $request)
    {
        $status = $request->query('status');
        $orders = $this->orderService->getUserOrders(Auth::id(), $status);

        return response()->json([
            'status' => true,
            'message' => 'Orders fetched successfully',
            'data' => $orders
        ]);
    }


    //tewo methods
    public function adminIndex()
    {
        $orders = Order::with('items')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:placed,received'
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }







    public function exportCsv()
    {
        $orders = Order::with('user')->get();

        $csvHeader = ['Order Number', 'User Name', 'Total Amount', 'Status'];
        $csvData = [];

        foreach ($orders as $order) {
            $csvData[] = [
                $order->order_number,
                $order->user->name ?? 'N/A',
                $order->total_amount,
                $order->status,

            ];
        }

        // Convert to CSV string
        $handle = fopen('php://temp', 'r+');
        fputcsv($handle, $csvHeader);

        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }

        rewind($handle);
        $csvOutput = stream_get_contents($handle);
        fclose($handle);

        return response($csvOutput)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename=orders.csv');
    }
}

