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
            <li><a href="dashboard.php" class="active">Dashboard</a></li>
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

<div class="dashboard-container">
    <!-- Left Side -->
    <div class="instruments-section">
        <table>
            <tr>
                <th>Instrument</th>
                <th>Sell</th>
                <th>Buy</th>
                <th>Spread</th>
                <th>% Change</th>
                <th>Today High</th>
                <th>Today Low</th>
            </tr>
            <!-- Data rows go here -->
        </table>
    </div>

    <!-- Right Side -->
    <div class="right-side">
    <div class="top-section">
        <div class="market-movers-section card">
            <h3>Market Movers</h3>
            <div class="gainers-losers">
                <div class="gainer">Top Gainer</div>
                <div class="loser">Top Loser</div>
            </div>
            <div class="see-more">See More</div>
        </div>

        <div class="most-traded-section card">
            <h3>Most Traded Pairs</h3>
            <div class="gainers-losers">
                <div class="gainer">Top Gainer</div>
                <div class="loser">Top Loser</div>
                <div class="data-container">
                </div>
            </div>
            <div class="see-more">See More</div>
        </div>
    </div>

    <div class="forex-chart-section">
        <h3>Forex Chart</h3>
        <img src="chart-image.png" alt="Forex Chart" class="chart-image">
    </div>
</div>
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