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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id', 5); // Ensures matching the patient_id type
            $table->decimal('amount_due', 8, 2);
            $table->decimal('amount_paid', 8, 2)->default(0);
            $table->timestamps();

            // Foreign Key Constraint
            $table->foreign('patient_id')
                ->references('patient_id')->on('patients')
                ->onDelete('cascade'); // Add cascading delete if needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
