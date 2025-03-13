<?php
session_start();
include "db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    // Check login attempts
    if (!isset($_SESSION["login_attempts"])) {
        $_SESSION["login_attempts"] = 0;
    }

    if ($_SESSION["login_attempts"] >= 5) {
        die("Too many login attempts. Try again later.");
    }

    $sql = "SELECT id, username, email, password, role FROM users WHERE username = ? OR email = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $username); // Allow login via username OR email
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row["password"])) {
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["role"] = $row["role"];

            // Set session expiration
            $_SESSION["last_login"] = time();

            // Redirect based on role
            if ($row["role"] == "admin") {
                header("Location: ../admin_dashboard.php"); // If it exists
            } else {
                header("Location: ../dashboard.php");
            }
            exit();
        } else {
            $_SESSION["login_attempts"]++;
            echo "Invalid login credentials!";
        }
    } else {
        $_SESSION["login_attempts"]++;
        echo "Invalid login credentials!";
    }
}
?>

<!-- Updated Login Form -->
<form action="login.php" method="POST">
    <input type="text" name="username" placeholder="Username or Email" required>
    <input type="password" name="password" placeholder="Enter Password" required>
    <button type="submit">Login</button>
</form>
