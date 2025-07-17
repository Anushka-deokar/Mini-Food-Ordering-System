<x-app-layout>
    <div class="max-w-6xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">My Orders</h2>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Order #</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Total</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Created</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $order->order_number }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2 py-1 rounded text-xs font-medium
                                            @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($order->status == 'completed') bg-green-100 text-green-800
                                            @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                                                @else bg-gray-100 text-gray-800
                                            @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800">₹{{ number_format($order->total_amount, 2) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $order->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">You have no orders yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $orders->links('pagination::tailwind') }}
        </div>
    </div>
</x-app-layout>