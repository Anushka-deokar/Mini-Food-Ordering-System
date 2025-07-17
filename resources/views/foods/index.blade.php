<x-app-layout>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Our Menu') }}
        </h2>
        </x-slot>

        <div class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            @forelse ($foods as $food)
                                <div
                                    class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 border border-gray-100">
                                    @if($food->image)
                                        <div class="relative h-48 overflow-hidden">
                                            <img src="{{ asset('storage/' . $food->image) }}"
                                                class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-300"
                                                alt="{{ $food->name }}">
                                        </div>
                                    @endif
                                    <div class="p-5">
                                        <h3 class="text-xl font-bold mb-3 text-gray-800">{{ $food->name }}</h3>
                                        <p class="text-gray-600 mb-4 text-sm">{{ Str::limit($food->description, 100) }}</p>
                                        <div class="flex items-center justify-between mb-5">
                                            <span class="text-2xl font-bold text-indigo-600">
                                                ${{ number_format($food->price, 2) }}
                                            </span>
                                        </div>
                                        <div class="grid grid-cols-2 gap-3">
                                            <a href="{{ route('foods.show', $food) }}"
                                                class="inline-flex justify-center items-center px-4 py-2.5 bg-gray-800 text-white rounded-lg font-medium text-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-700 transition-colors duration-200">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                View
                                            </a>
                                            <a href="{{ route('foods.show', $food) }}#order"
                                                class="inline-flex justify-center items-center px-4 py-2.5 bg-indigo-600 text-white rounded-lg font-medium text-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                                Order
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full text-center py-12">
                                    <p class="text-gray-500 text-lg">No food items available at the moment.</p>
                                </div>
                            @endforelse
                        </div>

                        <div class="mt-8">
                            {{ $foods->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>