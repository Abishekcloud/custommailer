<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
</head>
<body>
    <h1>Reset Password</h1>
    <h2>We have sent your Password Reset Link with an individual OTP</h2>
    <h3 class="alert alert-danger">Do not share this mail content with others</h3>
    <p>Click the given link to reset your password:</p>
    <a href="{{ route('resetPassword') }}">Reset Password</a>
    <h1>Your OTP is: {{ $otp }}</h1>
</body>
</html>
