<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToInventoryTable extends Migration
{
    public function up()
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->enum('item_type', ['consumable', 'equipment'])->after('item_name');
            $table->integer('threshold')->after('quantity_in_stock')->default(0);  // Low stock alert threshold
            $table->date('expiration_date')->nullable()->after('threshold');  // Expiration date for consumables
            $table->string('supplier_name')->nullable()->after('expiration_date');  // Supplier name
            $table->enum('status', ['active', 'expired', 'out_of_stock'])->default('active')->after('supplier_name'); // Item status
        });
    }

    public function down()
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropColumn(['item_type', 'threshold', 'expiration_date', 'supplier_name', 'status']);
        });
    }
}
