<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Form</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    <!-- Register Form -->
    <div class="register-container">
        <h2>Register</h2>
        <form action="{{ url('/register') }}" method="POST">
            <!-- Add CSRF token for security (if using Laravel) -->
            @csrf

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your full name" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <button type="submit" class="register-btn">Register</button>
        </form>

        <p class="footer-text">
            Already have an account? <a href="{{ url('/login') }}">Login</a>
        </p>
    </div>
</body>
</html>
