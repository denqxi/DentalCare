<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id', 5); // Set patient_id as varchar(5)
            $table->string('treatment_type');
            $table->dateTime('appointment_date');
            $table->enum('status', ['Pending', 'Completed', 'Cancelled']);
            $table->text('message')->nullable();
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('patient_id')->references('patient_id')->on('patients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
