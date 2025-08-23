<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Password Reset Code</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333;">

    <h2>Password Reset Request</h2>

    <p>We received a request to reset the password for your account.</p>

    <p>Please use the following 6-digit code to complete the process. This code is valid for 15 minutes.</p>

    <p style="font-size: 24px; font-weight: bold; letter-spacing: 5px; background-color: #f2f2f2; padding: 15px; border-radius: 5px; text-align: center;">
        {{ $code }}
    </p>

    <p>If you did not request a password reset, you can safely ignore this email. Your password will not be changed.</p>

    <br>
    <p>Thanks,</p>
    <p>The {{ config('app.name') }} Team</p>

</body>
</html>