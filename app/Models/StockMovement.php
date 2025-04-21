<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_id', 
        'movement_type', 
        'quantity', 
        'price', 
        'reason',
        'performed_by',
    ];

    // Define the relationship with the Inventory model
    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}