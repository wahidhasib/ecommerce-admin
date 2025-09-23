<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Request</title>
    <style>
        /* General reset */
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 4px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background-color: #262626;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .header h2 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 30px 20px;
            color: #333;
            line-height: 1.6;
        }

        .btn {
            display: inline-block;
            margin: 20px 0;
            padding: 12px 25px;
            background-color: #4CAF50;
            color: #fff !important;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .footer {
            font-size: 12px;
            color: #999;
            padding: 15px 20px;
            text-align: center;
            background-color: #f4f6f8;
        }

        @media screen and (max-width: 600px) {
            .container {
                margin: 20px 10px;
            }

            .content {
                padding: 20px 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h2>Password Reset Request</h2>
        </div>

        <!-- Content -->
        <div class="content">
            <p>{{ $bodyMessage }}</p>

            <p style="text-align:center;">
                <a href="{{ $resetLink }}" class="btn">Reset Password</a>
            </p>

            <p>If the button above does not work, copy and paste the following URL into your browser:</p>
            <p style="word-break: break-all;"><a href="{{ $resetLink }}">{{ $resetLink }}</a></p>

            <p>If you did not request a password reset, please ignore this email.</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            &copy; {{ date('Y') }} Your Company. All rights reserved.
        </div>
    </div>
</body>

</html>
