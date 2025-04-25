<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TreatmentRecord;    

class TreatmentRecordController extends Controller
{
    //
    public function showReport()
    {
        // Fetch all treatments with related patient data
        $treatments = TreatmentRecord::with('patient')->get();

        // Return the treatment report view
        return view('reports.treatment_report', compact('treatments'));
    }
}
