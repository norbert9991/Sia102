<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MarketPulse Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>

    <header>
        <div class="logo">MarketPulse</div>
        <nav>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Market</a></li>
                <li><a href="#">Trading</a></li>
                <li><a href="#">Portfolio</a></li>
            </ul>
        </nav>
    </header>

    <div class="background">
        <div class="login-container">
            <h2>Login</h2>
            <form action="php/login.php" method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>
                <button type="submit">Login</button>
            </form>
            <p><a href="#">Forgot password?</a></p>
            <p>Don't have an account? <a href="php/register.php">Register here</a></p>
        </div>
    </div>
    <footer>
    <p>&copy; 2025 MarketPulse. All Rights Reserved.</p>
</footer>
</body>
</html>
