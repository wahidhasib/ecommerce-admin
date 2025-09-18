<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h2>Password Reset Request</h2>
    <p>{{ $bodyMessage }}</p>
    <a href="{{ $resetLink }}"
        style="background:#4CAF50;color:#fff;padding:10px 15px;text-decoration:none;border-radius:5px;">
        Reset Password
    </a>
</body>

</html>
