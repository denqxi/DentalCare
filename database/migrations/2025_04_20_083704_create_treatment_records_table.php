<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('treatment_records', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id');  // Reference to the patient
            $table->date('treatment_date'); // The date of the treatment
            $table->text('treatment_details'); // Details of the treatment
            $table->timestamps();

            // Add a foreign key constraint to the patients table
            $table->foreign('patient_id')->references('patient_id')->on('patients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('treatment_records');
    }
};
