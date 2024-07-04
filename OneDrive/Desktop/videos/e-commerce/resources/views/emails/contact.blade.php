<!DOCTYPE html>
<html>
<head>
    <title>Contact Form Submission</title>
</head>
<body>
    <h1>Contact Form Submission</h1>
    <p>Name: {{ $details['name'] }}</p>
    <p>Email: {{ $details['email'] }}</p>
    {{-- <p>subject: {{ $details['subject'] }}</p> --}}
    <p>Message: {{ $details['message'] }}</p>
</body>
</html>
