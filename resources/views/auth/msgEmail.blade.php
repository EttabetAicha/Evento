<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template</title>
    <style>
        /* Define your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .email-container p {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 15px;
        }
        .email-container a {
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 3px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <p>Hello {{ $user->name }},</p>

        <p>We received a request to reset your password. Click the button below to reset it:</p>

        <a href="{{ url('changepass/'. $user->remember_token) }}">Reset your Password</a>
        <br>
        <br>
        <p>If you did not request a password reset, you can ignore this email.</p>

        <p>If you have any questions, please feel free to contact us.</p>

        <p>Thanks,<br>EVENTO</p>
    </div>
</body>
</html>