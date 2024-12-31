<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
<h1>Welcome, {{ $user->name }}!</h1>
<h1>Your email, {{ $user->email }}!</h1>
<h6>Your password, {{ $password }}!</h6>
<p>Thank you for registering with {{ config('app.name') }}. We're glad to have you!</p>
</body>
</html>
