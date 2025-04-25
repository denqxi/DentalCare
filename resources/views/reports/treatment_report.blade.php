<!-- resources/views/reports/treatment_report.blade.php -->
<h1>Treatment Report</h1>
<table>
    <thead>
        <tr>
            <th>Patient</th>
            <th>Treatment Type</th>
            <th>Procedure Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($treatments as $treatment)
            <tr>
                <td>{{ $treatment->patient->name }}</td>
                <td>{{ $treatment->treatment_type }}</td>
                <td>{{ $treatment->procedure_date }}</td>
                <td>{{ $treatment->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
