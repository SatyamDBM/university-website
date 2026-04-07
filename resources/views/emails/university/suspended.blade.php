<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Suspended</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #f4f6f9; padding: 40px 20px; }
        .wrapper { max-width: 600px; margin: 0 auto; }
        .header { background: linear-gradient(135deg, #f59e0b, #d97706); padding: 36px 40px; border-radius: 12px 12px 0 0; text-align: center; }
        .header img { width: 60px; height: 60px; margin-bottom: 16px; }
        .header h1 { color: #ffffff; font-size: 24px; font-weight: 700; letter-spacing: 0.5px; }
        .body { background: #ffffff; padding: 40px; border-left: 1px solid #e5e7eb; border-right: 1px solid #e5e7eb; }
        .status-badge { display: inline-block; background: #fef3c7; color: #92400e; padding: 6px 18px; border-radius: 20px; font-size: 13px; font-weight: 600; margin-bottom: 24px; }
        .body p { color: #374151; font-size: 15px; line-height: 1.8; margin-bottom: 16px; }
        .body p span { font-weight: 600; color: #111827; }
        .info-box { background: #fffbeb; border-left: 4px solid #f59e0b; border-radius: 6px; padding: 16px 20px; margin: 24px 0; }
        .info-box p { margin: 0; color: #92400e; font-size: 14px; }
        .contact-btn { display: block; width: fit-content; margin: 28px auto 0; background: linear-gradient(135deg, #f59e0b, #d97706); color: #ffffff; text-decoration: none; padding: 13px 32px; border-radius: 8px; font-size: 15px; font-weight: 600; text-align: center; }
        .divider { height: 1px; background: #e5e7eb; margin: 32px 0; }
        .footer { background: #f9fafb; padding: 24px 40px; border-radius: 0 0 12px 12px; border: 1px solid #e5e7eb; border-top: none; text-align: center; }
        .footer p { color: #9ca3af; font-size: 12px; line-height: 1.8; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>Account Suspended</h1>
        </div>

        <div class="body">
            <span class="status-badge">⚠️ Account Suspended</span>

            <p>Dear <span>{{ $user->name }}</span>,</p>

            <p>We are writing to inform you that your university account has been <span>suspended</span> by the administrator.</p>

            <p>During the suspension period, you will not be able to access your account or use any of the platform's features.</p>

            <div class="info-box">
                <p>⚠️ If you believe this action was taken by mistake or you would like to appeal this decision, please contact our support team immediately.</p>
            </div>

            <p>We take these actions seriously and encourage you to reach out so we can resolve any issues as quickly as possible.</p>

            <a href="mailto:support@example.com" class="contact-btn">Contact Support</a>

            <div class="divider"></div>

            <p style="font-size: 13px; color: #6b7280;">Account Email: <span>{{ $user->email }}</span></p>
        </div>

        <div class="footer">
            <p>This is an automated message, please do not reply directly to this email.</p>
            <p style="margin-top: 6px;">© {{ date('Y') }} All rights reserved.</p>
        </div>
    </div>
</body>
</html>