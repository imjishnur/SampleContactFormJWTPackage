<!DOCTYPE html>
<html>

<head>
    <title>New Contact Submission</title>
</head>

<body>
    <h1>New Message from {{ $submission->name }}</h1>
    <p><strong>Email:</strong> {{ $submission->email }}</p>
    <p><strong>Subject:</strong> {{ $submission->subject }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $submission->message }}</p>

    <p><small>Submitted at: {{ $submission->created_at }}</small></p>
</body>

</html>