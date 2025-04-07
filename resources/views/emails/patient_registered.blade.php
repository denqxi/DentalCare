<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Our Clinic</title>
</head>
<body>
    <h2>Hello {{ $patient->first_name }} {{ $patient->last_name }},</h2>
    
    <p>Thank you for registering with our clinic.</p>
    
    <p>Your **Patient ID**: <strong>{{ $patient->patient_id }}</strong></p>
    
    <p>We look forward to serving you!</p>

    <p>Best regards,<br>
    Your Clinic Team</p>
</body>
</html>
