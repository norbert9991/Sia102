<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: ../index.php");
    exit();
}

// Retrieve the amount and period from the URL parameters
$amount = isset($_GET['amount']) ? $_GET['amount'] : '10,000';
$period = isset($_GET['period']) ? $_GET['period'] : '1month';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Long Term Analysis - MarketPulse</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Chart.js for displaying charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

<main class="long-term-analysis-container">
    <!-- Long Term Analysis Title -->
    <div class="analysis-title">
        <h1>Long Term Analysis</h1>
    </div>

    <!-- Charts Section -->
    <div class="charts-section">
        <!-- Simulation Results Box -->
        <div class="simulation-results">
            <h2>Simulation Results</h2>
            <table>
                <tr>
                    <td>Starting Balance</td>
                    <td>$ 100,000</td>
                </tr>
                <tr>
                    <td>Ending Balance</td>
                    <td>$ 111,617.02</td>
                </tr>
                <tr>
                    <td># Trades</td>
                    <td>2,137</td>
                </tr>
                <tr>
                    <td>Avg Monthly P/L</td>
                    <td>$ 484.04 (0.48%)</td>
                </tr>
                <tr>
                    <td>Total Profit</td>
                    <td>$ 11,617.02 (11.62%)</td>
                </tr>
            </table>
        </div>

        <!-- Balance Chart -->
        <div class="chart-container">
            <h2>Balance</h2>
            <canvas id="balanceChart"></canvas>
        </div>

        <!-- Monthly P/L Chart -->
        <div class="chart-container">
            <h2>Monthly P/L</h2>
            <canvas id="monthlyPLChart"></canvas>
        </div>
    </div>

    <!-- Insights Section -->
    <div class="insights-section">
        <h2>Insights</h2>
        <p>
            Based on the selected strategies and allocated funds, here are some insights:
            <ul>
                <li>Your portfolio has shown excellent investment opportunities over the selected period.</li>
                <li>The "Legend" strategy demonstrates its potential to be successful.</li>
                <li>Consider reallocating funds to the "Alpha" strategy for better diversification.</li>
            </ul>
        </p>
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
    // JavaScript for initializing charts
    const balanceCtx = document.getElementById('balanceChart').getContext('2d');
    const monthlyPLCtx = document.getElementById('monthlyPLChart').getContext('2d');

    // Balance Chart
    const balanceChart = new Chart(balanceCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'Balance',
                data: [5000, 6000, 7000, 8000, 9000, 10000, 11000],
                borderColor: '#4db8ff',
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Month'
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Amount (₱)'
                    }
                }
            }
        }
    });

    // Monthly P/L Chart
    const monthlyPLChart = new Chart(monthlyPLCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'Monthly P/L',
                data: [1000, 1500, 2000, 2500, 3000, 3500, 4000],
                backgroundColor: '#ff6b6b',
                borderColor: '#ff8e53',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Month'
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Amount (₱)'
                    }
                }
            }
        }
    });
</script>

</body>
</html>