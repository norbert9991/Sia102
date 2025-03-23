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
    <title>Portfolio - MarketPulse</title>
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
            <li><a href="portfolio.php" class="active">Portfolio</a></li>
        </ul>
    </nav>
    <div class="user-profile">
        <i class="fa fa-user-circle"></i> 
        <span><?php echo $_SESSION["username"]; ?></span>
        <a href="php/logout.php" class="logout-btn">Logout</a>
    </div>
</header>

<!-- Portfolio Content -->
<div class="portfolio-container">
    <!-- Top Section: 4 Boxes -->
    <div class="portfolio-top-boxes">
        <div class="portfolio-box">
            <h3>Virtual Money</h3>
        </div>
        <div class="portfolio-box">
            <h3>Gained Money</h3>
        </div>
        <div class="portfolio-box">
            <h3>Spent Money</h3>
        </div>
        <div class="portfolio-box">
            <h3>Lost Money</h3>
        </div>
    </div>

    <!-- Middle Section: 2 Charts -->
    <div class="portfolio-middle-boxes">
        <div class="portfolio-chart">
            <h3>Allocated Pair</h3>
        </div>
        <div class="chart-card">
            <h3>Chart</h3>
        </div>
    </div>

    <!-- Bottom Section: 1 Big Box -->
    <div class="portfolio-bottom-box">
        <div class="portfolio-big-box">
            <h3>Recent Transactions</h3>
            <table>
                <thead>
                    <tr>
                        <th>Pair</th>
                        <th>Balance</th>
                        <th>Price</th>
                        <th>Lost 7D</th>
                        <th>Value</th>
                    </tr>
                </thead>
            </table>
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