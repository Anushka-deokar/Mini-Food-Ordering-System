<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 leading-tight">
            {{ __('View Orders') }}
        </h2>
    </x-slot>
    <a href="{{ route('admin.orders.export') }}"
   class="inline-block mb-4 px-4 py-2 bg-green-600 text-black rounded-md hover:bg-green-700">
   Export Orders as CSV
</a>

    <div class="py-10">
        <div class="max-w-6xl mx-auto" style="padding: 1rem; background: #fff; border-radius: 8px; border: 1px solid #ccc;">
            @if(session('success'))
                <div style="color: green; font-weight: bold; margin-bottom: 1rem;">
                    {{ session('success') }}
                </div>
            @endif

            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f0f0f0;">
                        <th style="text-align: left; padding: 8px;">Order #</th>
                        <th style="text-align: left; padding: 8px;">User</th>
                        <th style="text-align: left; padding: 8px;">Total Price</th>
                        <th style="text-align: left; padding: 8px;">Status</th>
                        <th style="text-align: left; padding: 8px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr style="border-top: 1px solid #ddd;">
                            <td style="padding: 8px;">{{ $order->order_number ?? 'ORD-' . $order->id }}</td>
                            <td style="padding: 8px;">{{ $order->user->name ?? 'N/A' }}</td>
                            <td style="padding: 8px; font-weight: bold;">${{ number_format($order->total_amount, 2) }}</td>
                            <td style="padding: 8px; color: #007BFF;">{{ $order->status }}</td>
                            <td style="padding: 8px;">
                                @switch($order->status)
                                    @case('pending')
                                        <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            <input type="hidden" name="status" value="placed">
                                            <button type="submit" style="background: green; color: white; border: none; padding: 6px 12px; border-radius: 4px;">
                                                Mark as Placed
                                            </button>
                                        </form>
                                        @break
                                    @case('placed')
                                        <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            <input type="hidden" name="status" value="completed">
                                            <button type="submit" style="background: blue; color: white; border: none; padding: 6px 12px; border-radius: 4px;">
                                                 Completed
                                            </button>
                                        </form>
                                        @break
                                    @case('completed')
                                        <span style="background: #ffe6e6; color: red; padding: 4px 8px; border-radius: 4px; font-weight: bold;">
                                            Completed
                                        </span>
                                        @break
                                @endswitch
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 16px; color: #666;">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

<div class="mt-4">
    {{ $orders->links('pagination::tailwind') }}
</div>
        </div>
    </div>
</x-app-layout>
