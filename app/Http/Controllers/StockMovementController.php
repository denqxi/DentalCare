<?php

namespace App\Http\Controllers;

use App\Models\StockMovement;
use App\Models\Inventory;
use Illuminate\Http\Request;

class StockMovementController extends Controller
{
    // Show form for creating stock movement (Stock In, Out, or Adjustment)
    public function create($inventory_id, $movement_type)
    {
        $inventoryItem = Inventory::findOrFail($inventory_id);

        return view('stock_movements.create', compact('inventoryItem', 'movement_type'));
    }

    // Store a new stock movement
    public function store(Request $request)
    {
        $request->validate([
            'inventory_id' => 'required|exists:inventories,id',
            'movement_type' => 'required|in:in,out,adjustment',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'reason' => 'nullable|string|max:255',
            'performed_by' => 'nullable|string|max:255',
        ]);

        // Create stock movement record
        $movement = StockMovement::create($request->all());

        // Update inventory quantity based on movement type
        $inventory = Inventory::find($request->inventory_id);
        if ($request->movement_type == 'in') {
            $inventory->quantity_in_stock += $request->quantity;
        } elseif ($request->movement_type == 'out') {
            $inventory->quantity_in_stock -= $request->quantity;
        } elseif ($request->movement_type == 'adjustment') {
            $inventory->quantity_in_stock = $request->quantity; // Set exact quantity for adjustment
        }
        $inventory->save();

        return redirect()->route('inventory.index')->with('success', 'Stock movement recorded successfully.');
    }
}