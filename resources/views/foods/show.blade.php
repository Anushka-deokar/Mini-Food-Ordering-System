<x-app-layout>
    <x-slot:header>
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ $food->name }}
        </h2>
        </x-slot>

        <div class="py-12 bg-gray-100">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white p-6 rounded-lg shadow-lg grid md:grid-cols-2 gap-6">

                    <!-- Food Image -->
                    <div>
                        @if($food->image)
                            <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->name }}"
                                class="w-full h-72 object-cover rounded-lg shadow">
                        @else
                            <div class="w-full h-72 bg-gray-200 flex items-center justify-center rounded-lg text-gray-500">
                                No image available
                            </div>
                        @endif
                    </div>

                    <!-- Food Details + Order Form -->
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-800 mb-2">{{ $food->name }}</h1>
                        <p class="text-gray-600 mb-4">{{ $food->description }}</p>
                        <p class="text-green-600 text-xl font-bold mb-4">${{ number_format($food->price, 2) }}</p>

                        <form action="{{ route('orders.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="items[0][food_id]" value="{{ $food->id }}">

                            <div class="mb-4">
                                <label for="quantity"
                                    class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                                <input type="number" name="items[0][quantity]" id="quantity" value="1" min="1" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:ring-red-500 focus:border-red-500">
                            </div>

                            @if($errors->any())
                                <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-600 rounded-md">
                                    <ul class="list-disc list-inside">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <button type="submit"
                                class="w-full bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                Place Order
                            </button>
                        </form>

                        <a href="{{ route('foods.index') }}" class="inline-block mt-4 text-indigo-600 hover:underline">
                            ← Back to Menu
                        </a>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>