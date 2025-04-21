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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id', 5);  // Ensure it matches patients.patient_id data type
            $table->string('prescription_details');
            $table->timestamps();

            // Add the foreign key constraint
            $table->foreign('patient_id')
                ->references('patient_id')->on('patients')
                ->onDelete('cascade'); // Optionally, add cascading delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
