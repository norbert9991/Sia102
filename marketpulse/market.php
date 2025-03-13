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
    <title>Dashboard - MarketPulse</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<header>
    <div class="logo">MarketPulse</div>
    <nav>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="market.php" class="active">Market</a></li>
            <li><a href="trading.php">Pocket Trading</a></li>
            <li><a href="users.php">User Management</a></li>
            <li><a href="portfolio.php">Portfolio</a></li>
        </ul>
    </nav>
    <div class="user-profile">
        <i class="fa fa-user-circle"></i> 
        <span><?php echo $_SESSION["username"]; ?></span>
        <a href="php/logout.php" class="logout-btn">Logout</a>
    </div>
</header>

<!-- MARKET DATA SECTION -->
<div class="market-container">
    <h2>Market Rates in Real Time</h2>

    <div class="gainers-losers-buttons">
        <button class="gainers-btn">Top Gainers</button>
        <button class="loser-btn">Top Loser</button>
    </div>

    <table class="market-table">
    <thead>
        <tr>
            <th>Instrument</th>
            <th>Sell</th>
            <th>Buy</th>
            <th>Spread</th>
            <th>% Change</th>
            <th>Today High</th>
            <th>Today Low</th>
        </tr>
    </thead>
    <tbody>
        <!-- Data Rows Will Be Dynamically Inserted Here -->
    </tbody>
</table>

<!-- Add a div for space -->
<div style="height: 400px;"></div>

<a href="trading.php" class="pocket-trading-btn">Try our pocket trading tool!</a>
</div>

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

</body>
</html>
