<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Inventory;

class CheckLowStock extends Command
{
    protected $signature = 'inventory:check-low-stock';
    protected $description = 'Check low stock items';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Define the low stock threshold value (e.g., 10)
        $threshold = 10;

        // Retrieve items where the stock quantity is less than the threshold
        $lowStockItems = Inventory::where('quantity_in_stock', '<', $threshold)->get();

        // Check if any items are low on stock
        if ($lowStockItems->isEmpty()) {
            $this->info('No low stock items.');
        } else {
            foreach ($lowStockItems as $item) {
                // Send email or notification about low stock
                $this->info('Low stock alert: ' . $item->item_name);
            }
        }
    }
}
