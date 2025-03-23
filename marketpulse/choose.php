<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: ../index.php");
    exit();
}

// Retrieve the amount from the URL parameter
$amount = isset($_GET['amount']) ? $_GET['amount'] : '10,000';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Trading Type - MarketPulse</title>
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
            <li><a href="trading.php">Pocket Trading</a></li>
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

<main class="choose-container">
    <h1 class="choose-title">Choose Your Trading Type</h1>
    <p class="simulation-amount">Simulation Amount: <span>₱<?php echo $amount; ?></span></p>
    <div class="trading-options">
        <!-- Short Term Trading Box -->
        <div class="trading-option" onclick="confirmTradingType('short')">
            <h2>Short Term Trading</h2>
            <p>
                Trade almost in real-time or with delays of 2, 5, 10, or 30 minutes. 
                Ideal for quick decisions and fast-paced market movements.
            </p>
        </div>

        <!-- Long Term Trading Box -->
        <div class="trading-option" onclick="confirmTradingType('long')">
            <h2>Long Term Trading</h2>
            <p>
                Trade over longer periods such as 1, 2, 3, or 6 months. 
                Perfect for strategic planning and holding positions for extended periods.
            </p>
        </div>
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
    // Function to confirm trading type selection
    function confirmTradingType(type) {
        const message = type === 'short' 
            ? "Do you really choose Short Term Trading?" 
            : "Do you really choose Long Term Trading?";

        const confirmRedirect = confirm(message); // Show confirmation dialog

        if (confirmRedirect) {
            const amount = <?php echo json_encode($amount); ?>;
            if (type === 'short') {
                window.location.href = `short_term.php?amount=${amount}`;
            } else if (type === 'long') {
                window.location.href = `long_term_period.php?amount=${amount}`;
            }
        }
    }
</script>

</body>
</html>