@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <h2 class="text-2xl font-semibold leading-tight mb-4">Inventory List</h2>

        <!-- Search & Filter Form -->
        <form method="GET" action="{{ route('inventory.index') }}" class="flex flex-col md:flex-row gap-4 mb-6">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Search item name..."
                class="w-full md:w-1/2 px-4 py-2 border rounded-md shadow-sm focus:ring focus:ring-purple-200">

            <select name="category" class="w-full md:w-1/4 px-4 py-2 border rounded-md shadow-sm focus:ring focus:ring-purple-200">
                <option value="">All Categories</option>
                <option value="dental" {{ request('category') === 'dental' ? 'selected' : '' }}>Dental</option>
                <option value="hygiene" {{ request('category') === 'hygiene' ? 'selected' : '' }}>Hygiene</option>
                <option value="tools" {{ request('category') === 'tools' ? 'selected' : '' }}>Tools</option>
                <!-- Add more categories as needed -->
            </select>

            <button type="submit"
                class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">Filter</button>
        </form>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-200 divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Item Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($inventoryItems as $item)
                        <tr>
                            <td class="px-6 py-4">{{ $item->item_name }}</td>
                            <td class="px-6 py-4 capitalize">{{ $item->category }}</td>
                            <td class="px-6 py-4">{{ $item->quantity_in_stock }}</td>
                            <td class="px-6 py-4">₱{{ number_format($item->price_per_unit, 2) }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('stock-movements.create', ['inventory_id' => $item->id, 'movement_type' => 'in']) }}"
                                    class="text-green-600 hover:text-green-900">Stock In</a> |
                                <a href="{{ route('stock-movements.create', ['inventory_id' => $item->id, 'movement_type' => 'out']) }}"
                                    class="text-red-600 hover:text-red-900">Stock Out</a> |
                                <a href="{{ route('stock-movements.create', ['inventory_id' => $item->id, 'movement_type' => 'adjustment']) }}"
                                    class="text-blue-600 hover:text-blue-900">Adjust Stock</a> |
                                <a href="#" class="text-blue-600 hover:text-blue-900">Edit</a> |
                                <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No inventory items found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
