<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Patient;

class PatientRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $patient;

    /**
     * Create a new message instance.
     */
    public function __construct(Patient $patient)
    {
        $this->patient = $patient;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Welcome to Our Clinic, ' . $this->patient->first_name . '!')
                    ->view('emails.patient_registered');
    }
}