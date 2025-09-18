<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password</title>
</head>

<body>
    <h2>Forgot Password</h2>

    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

    <form method="POST" action="">
        @csrf
        <input type="email" name="email" placeholder="Enter your email" required>
        @error('email')
            <p>{{ $message }}</p>
        @enderror
        <button type="submit">Send Reset Link</button>
    </form>
</body>

</html>
