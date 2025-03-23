<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pocket Trading - MarketPulse</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<header>
    <div class="logo">MarketPulse</div>
    <nav>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="market.php">Market</a></li>
            <li><a href="trading.php" class="active">Pocket Trading</a></li>
            <li><a href="usermanagement.php">User Management</a></li>
            <li><a href="portfolio.php">Portfolio</a></li>
        </ul>
    </nav>
    <div class="user-profile">
        <i class="fa fa-user-circle"></i> 
        <span><?php echo $_SESSION["username"]; ?></span>
        <a href="php/logout.php" class="logout-btn">Logout</a>
    </div>
</header>

<main class="trading-container">
    <h1 class="pocket-trade-title">Pocket Trade</h1>
    <div class="trading-box">
        <h2>Set Your Simulation Amount</h2>
        <p class="simulation-instruction">Choose your initial simulation balance and begin</p>
        <div class="amount-display">
            <span id="amount">₱10,000</span>
        </div>
        <input type="range" id="slider" min="1000" max="100000" step="1000" value="10000">
        <button class="start-trading-btn" onclick="redirectToChoose()">Start Trading</button>
    </div>
</main>

<footer>
    <p>&copy; 2025 MarketPulse. All Rights Reserved.</p>
    <div class="footer-links">
        <a href="#">About Us</a> | <a href="#">Terms and Conditions</a>
    </div>
    <div class="social-icons">
        <a href="#"><i class="fa-brands fa-instagram"></i></a>
        <a href="#"><i class="fa-brands fa-twitter"></i></a>
    </div>
</footer>

<script>
    const slider = document.getElementById('slider');
    const amountDisplay = document.getElementById('amount');

    slider.addEventListener('input', function() {
        const value = parseInt(slider.value).toLocaleString();
        amountDisplay.textContent = `₱${value}`; // Add ₱ sign before the amount
    });

    // Initialize the amount with the ₱ sign on page load
    window.onload = function() {
        const initialValue = parseInt(slider.value).toLocaleString();
        amountDisplay.textContent = `₱${initialValue}`;
    };

    // Function to redirect to choose.php
    function redirectToChoose() {
    const amount = parseInt(slider.value);
    window.location.href = `choose.php?amount=${amount}`;
}
</script>

</body>
</html>