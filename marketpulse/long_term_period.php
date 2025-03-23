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
    <title>Long Term Period - MarketPulse</title>
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

<main class="long-term-period-container">
    <!-- Centered Title -->
    <div class="pocket-trade-title">
        <h1>Pocket Trade</h1>
    </div>

    <!-- Panel for Content -->
    <div class="simulation-panel">
        <!-- Simulation Period Selection -->
        <div class="simulation-period">
            <label for="simulationPeriod">Select Simulation Period</label>
            <p class="simulation-description">
                Selecting a simulation period will display real trading history over the chosen time frame. 
                For example, by selecting 1 Year, you will get a simulation of the past year.
            </p>
            <select id="simulationPeriod" name="simulationPeriod">
                <option value="1month">1 Month</option>
                <option value="3months">3 Months</option>
                <option value="6months">6 Months</option>
                <option value="1year">1 Year</option>
                <option value="2years">2 Years</option>
            </select>
        </div>

        <!-- Simulation Amount Display -->
        <div class="simulation-amount">
            <p>Your Simulation Amount: <span>$<?php echo htmlspecialchars($amount); ?></span></p>
        </div>

        <!-- Start Simulation Button -->
        <div class="start-simulation">
            <button id="startSimulationBtn">Start Simulation</button>
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
    // JavaScript for handling the simulation start
    document.getElementById('startSimulationBtn').addEventListener('click', function() {
        const period = document.getElementById('simulationPeriod').value;
        const amount = "<?php echo htmlspecialchars($amount); ?>"; // Use the PHP $amount variable
        window.location.href = `long_term_strat.php?amount=${amount}&period=${period}`;
    });
</script>

</body>
</html>