<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\History;

class PatientHistoryController extends Controller
{
    // Show list of all patients for history
    public function index()
    {
        $patients = Patient::all(); // you can also paginate: Patient::paginate(10);
        return view('history.index', compact('patients'));
    }

    // Show detailed history for a specific patient
    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        $histories = History::where('patient_id', $id)->orderBy('date', 'desc')->get();

        return view('history.show', compact('patient', 'histories'));
    }
}
