<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Activated</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #f4f6f9; padding: 40px 20px; }
        .wrapper { max-width: 600px; margin: 0 auto; }
        .header { background: linear-gradient(135deg, #10b981, #059669); padding: 36px 40px; border-radius: 12px 12px 0 0; text-align: center; }
        .header h1 { color: #ffffff; font-size: 24px; font-weight: 700; letter-spacing: 0.5px; }
        .body { background: #ffffff; padding: 40px; border-left: 1px solid #e5e7eb; border-right: 1px solid #e5e7eb; }
        .status-badge { display: inline-block; background: #d1fae5; color: #065f46; padding: 6px 18px; border-radius: 20px; font-size: 13px; font-weight: 600; margin-bottom: 24px; }
        .body p { color: #374151; font-size: 15px; line-height: 1.8; margin-bottom: 16px; }
        .body p span { font-weight: 600; color: #111827; }
        .info-box { background: #ecfdf5; border-left: 4px solid #10b981; border-radius: 6px; padding: 16px 20px; margin: 24px 0; }
        .info-box p { margin: 0; color: #065f46; font-size: 14px; }
        .features { margin: 24px 0; }
        .feature-item { display: flex; align-items: center; gap: 10px; padding: 10px 0; border-bottom: 1px solid #f3f4f6; }
        .feature-item:last-child { border-bottom: none; }
        .feature-item span { color: #374151; font-size: 14px; }
        .login-btn { display: block; width: fit-content; margin: 28px auto 0; background: linear-gradient(135deg, #10b981, #059669); color: #ffffff; text-decoration: none; padding: 13px 32px; border-radius: 8px; font-size: 15px; font-weight: 600; text-align: center; }
        .divider { height: 1px; background: #e5e7eb; margin: 32px 0; }
        .footer { background: #f9fafb; padding: 24px 40px; border-radius: 0 0 12px 12px; border: 1px solid #e5e7eb; border-top: none; text-align: center; }
        .footer p { color: #9ca3af; font-size: 12px; line-height: 1.8; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>Account Activated</h1>
        </div>

        <div class="body">
            <span class="status-badge">✅ Account Activated</span>

            <p>Dear <span>{{ $user->name }}</span>,</p>

            <p>Great news! Your university account has been <span>activated</span> successfully by the administrator.</p>

            <p>You now have full access to all platform features. Here is what you can do:</p>

            <div class="features">
                <div class="feature-item">
                    <span>✔️ Access your university dashboard</span>
                </div>
                <div class="feature-item">
                    <span>✔️ Manage students and faculty</span>
                </div>
                <div class="feature-item">
                    <span>✔️ Use all platform services</span>
                </div>
                <div class="feature-item">
                    <span>✔️ View reports and analytics</span>
                </div>
            </div>

            <div class="info-box">
                <p>✅ Your account is now fully active. Login to get started right away!</p>
            </div>

            <a href="#" class="login-btn">Login to Dashboard</a>

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