@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <h2 class="text-2xl font-semibold leading-tight mb-4">Record Stock Movement for {{ $inventoryItem->item_name }}</h2>

        <form action="{{ route('stock-movements.store') }}" method="POST">
            @csrf
            <input type="hidden" name="inventory_id" value="{{ $inventoryItem->id }}">
            <input type="hidden" name="movement_type" value="{{ $movement_type }}">

            <div class="mb-4">
                <label for="quantity" class="block text-gray-700">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-input mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label for="price" class="block text-gray-700">Price</label>
                <input type="number" name="price" id="price" class="form-input mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label for="reason" class="block text-gray-700">Reason</label>
                <input type="text" name="reason" id="reason" class="form-input mt-1 block w-full">
            </div>

            <div class="mb-4">
                <label for="performed_by" class="block text-gray-700">Performed By</label>
                <input type="text" name="performed_by" id="performed_by" class="form-input mt-1 block w-full">
            </div>

            <button type="submit" class="btn btn-primary">Submit Movement</button>
        </form>
    </div>
</div>
@endsection