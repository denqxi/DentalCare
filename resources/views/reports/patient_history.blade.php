<!-- resources/views/reports/patient_history.blade.php -->
<h1>Patient History Report</h1>
<table>
    <thead>
        <tr>
            <th>Patient Name</th>
            <th>Treatment</th>
            <th>Appointment Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($patients as $patient)
            @foreach ($patient->appointments as $appointment)
                <tr>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $appointment->appointment_date }}</td>
                    <td>{{ $appointment->status }}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
