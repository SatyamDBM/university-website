<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Multiple Leads Assigned</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 30px;">
    <div style="max-width: 1000px; margin: auto; background: #ffffff; padding: 30px; border-radius: 10px;">
        
        <h2 style="margin-bottom: 20px;">Hello {{ $assignedUser->name }},</h2>

        <p>{{ $records->count() }} new leads have been assigned to you.</p>

        <table width="100%" cellpadding="10" cellspacing="0" border="1" style="border-collapse: collapse; margin-top: 20px;">
            <thead style="background-color: #f3f4f6;">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Course</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $index => $record)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $record->name }}</td>
                        <td>{{ $record->email }}</td>
                        <td>{{ $record->mobile ?? '-' }}</td>
                        <td>{{ $record->course ?? '-' }}</td>
                        <td>{{ $record->message ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p style="margin-top: 20px;">
            Please login to your panel for more details.
        </p>
    </div>
</body>
</html>