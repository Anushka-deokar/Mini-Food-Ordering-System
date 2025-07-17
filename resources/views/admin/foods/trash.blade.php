<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold">Trash</h1>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('admin.foods.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                Back to Foods
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white shadow-md rounded my-6">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Description</th>
                        <th class="py-3 px-6 text-center">Price</th>
                        <th class="py-3 px-6 text-center">Deleted At</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @foreach($foods as $food)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left">{{ $food->name }}</td>
                            <td class="py-3 px-6 text-left">{{ Str::limit($food->description, 50) }}</td>
                            <td class="py-3 px-6 text-center">${{ number_format($food->price, 2) }}</td>
                            <td class="py-3 px-6 text-center">{{ $food->deleted_at->format('Y-m-d H:i:s') }}</td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex justify-center items-center space-x-2">
                                    <form action="{{ route('admin.foods.restore', $food->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-600 text-green px-3 py-1 rounded text-sm">
                                            Restore
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.foods.force-delete', $food->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-red px-3 py-1 rounded text-sm"
                                            onclick="return confirm('Are you sure you want to permanently delete this item?')">
                                            Delete Permanently
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="px-6 py-4">
                {{ $foods->links() }}
            </div>
        </div>
    </div>
</x-app-layout>