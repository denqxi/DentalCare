<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\MedicalHistory;
use App\Models\TreatmentRecord;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';
    protected $primaryKey = 'patient_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'patient_id',
        'first_name',
        'middle_name',
        'last_name',
        'birth_date',
        'gender',
        'address',
        'email',
        'phone_number', 
    ];    

    // Auto-generate unique 5-character patient_id
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($patient) {
            $patient->patient_id = self::generateUniqueId();
        });
    }

    // Function to generate a unique 5-character ID
    private static function generateUniqueId()
    {
        do {
            $uniqueId = Str::upper(Str::random(5)); 
        } while (self::where('patient_id', $uniqueId)->exists());

        \Log::info("Generated patient ID: " . $uniqueId); // ✅ Log the generated ID

        return $uniqueId;
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id', 'patient_id');
    }

    public function medicalHistories()
    {
        return $this->hasMany(MedicalHistory::class, 'patient_id');
    }

    public function treatmentRecords()
    {
        return $this->hasMany(TreatmentRecord::class, 'patient_id');
    }

}
