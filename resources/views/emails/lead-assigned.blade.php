<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Lead Assigned</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 30px;">
    <div style="max-width: 700px; margin: auto; background: #ffffff; padding: 30px; border-radius: 10px;">
        <h2 style="margin-bottom: 20px;">Hello {{ $assignedUser->name }},</h2>

        <p>A new lead has been assigned to you.</p>

        <table width="100%" cellpadding="10" cellspacing="0" border="1" style="border-collapse: collapse; margin-top: 20px;">
            <tr>
                <td><strong>Name</strong></td>
                <td>{{ $record->name }}</td>
            </tr>
            <tr>
                <td><strong>Email</strong></td>
                <td>{{ $record->email }}</td>
            </tr>
            <tr>
                <td><strong>Mobile</strong></td>
                <td>{{ $record->mobile ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Course</strong></td>
                <td>{{ $record->course ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Message</strong></td>
                <td>{{ $record->message ?? '-' }}</td>
            </tr>
        </table>

        <p style="margin-top: 20px;">
            Please login to your panel for more details.
        </p>
    </div>
</body>
</html>