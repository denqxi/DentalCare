<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockMovementsTable extends Migration
{
    public function up()
    {
        // Check if the table already exists before creating it
        if (!Schema::hasTable('stock_movements')) {
            Schema::create('stock_movements', function (Blueprint $table) {
                $table->id();
                $table->foreignId('inventory_id')->constrained()->onDelete('cascade');
                $table->enum('type', ['in', 'out', 'adjustment']);
                $table->integer('quantity');
                $table->string('reason')->nullable();
                $table->string('performed_by')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('stock_movements');
    }
}