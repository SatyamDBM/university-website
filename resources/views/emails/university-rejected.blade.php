<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>University Request Rejected</title>
    <style>
        body {
            margin: 0; padding: 0;
            background: #f4f7fb;
            font-family: 'Segoe UI', Arial, sans-serif;
            color: #111827;
        }
        .wrapper {
            max-width: 560px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        }
        .header {
            background: #775042;
            padding: 32px 36px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            color: #ffffff;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -0.02em;
        }
        .body {
            padding: 32px 36px;
        }
        .body p {
            font-size: 15px;
            line-height: 1.7;
            color: #374151;
            margin: 0 0 16px;
        }
        .reason-box {
            background: #fef2f2;
            border-left: 4px solid #dc2626;
            border-radius: 6px;
            padding: 16px 20px;
            margin: 20px 0;
            font-size: 14px;
            color: #7f1d1d;
            line-height: 1.6;
        }
        .reason-box strong {
            display: block;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #dc2626;
            margin-bottom: 6px;
        }
        .footer {
            background: #f9fafb;
            border-top: 1px solid #e5e7eb;
            padding: 20px 36px;
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>University Request Update</h1>
        </div>
        <div class="body">
            <p>Dear <strong>{{ $user->name }}</strong>,</p>
            <p>
                We regret to inform you that your university registration request has been
                <strong style="color:#dc2626;">rejected</strong> after review by our team.
            </p>
            <div class="reason-box">
                <strong>Reason for Rejection</strong>
                {{ $rejectionReason }}
            </div>
            <p>
                If you believe this decision was made in error or you have additional information
                to provide, please contact our support team for further assistance.
            </p>
            <p>Thank you for your understanding.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} All rights reserved.
        </div>
    </div>
</body>
</html>