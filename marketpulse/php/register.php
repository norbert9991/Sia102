<?php
include "db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $error = "";

    // Validate Password
    if ($password !== $confirm_password) {
        $error = "⚠ Passwords do not match!";
    } else {
        // Hash Password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // SQL Insert Query
        $sql = "INSERT INTO users (username, email, phone, password, role) VALUES (?, ?, ?, ?, 'user')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $email, $phone, $hashed_password);

        if ($stmt->execute()) {
            header("Location: ../index.php?success=registered");
            exit();
        } else {
            $error = "⚠ Registration failed. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - MarketPulse</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <div class="logo">MarketPulse</div>
        <nav>
            <ul>
                <li><a href="../index.php">Dashboard</a></li>
                <li><a href="#">Market</a></li>
                <li><a href="#">Trading</a></li>
                <li><a href="#">Portfolio</a></li>
            </ul>
        </nav>
    </header>

    <div class="background">
        <div class="login-container">
            <h2>Sign Up</h2>
            <p>Just some details to get you in!</p>

            <?php if (!empty($error)): ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php endif; ?>

            <form action="register.php" method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="tel" name="phone" placeholder="Phone Number" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                <button type="submit">Sign Up</button>
            </form>

            <p>Already registered? <a href="../index.php">Login here</a></p>
        </div>
    </div>

    <footer>
        &copy; 2025 MarketPulse. All Rights Reserved.
    </footer>
</body>
</html>
