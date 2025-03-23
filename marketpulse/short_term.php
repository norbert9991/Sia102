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
    <title>Short Term Trading - MarketPulse</title>
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

<main class="short-term-container">
    <!-- Left Side: Forex Data and Charts -->
    <div class="forex-data">
        <h2>Forex Market Data</h2>
        <div class="forex-value">
            <span id="forex-price">Loading...</span>
            <span id="forex-change">Loading...</span>
        </div>
        <div class="chart-container" style="width: 100%; height: 300px;">
            <canvas id="forexChart"></canvas>
        </div>
        <div class="open-orders">
            <h3>Open Orders</h3>
            <table>
                <thead>
                    <tr>
                        <th>Side</th>
                        <th>Size</th>
                        <th>Filled (USD)</th>
                        <th>Price (PHP)</th>
                        <th>Fee (PHP)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5">No orders to show</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Right Side: Order Form -->
    <div class="order-form">
        <h2>Order Form</h2>
        <form id="orderForm">
            <div class="form-group">
                <label for="orderType">Order Type</label>
                <select id="orderType" name="orderType">
                    <option value="buy">BUY</option>
                    <option value="sell">SELL</option>
                </select>
            </div>
            <div class="form-group">
                <label for="amount">Amount (USD)</label>
                <input type="number" id="amount" name="amount" placeholder="0.00 USD" required>
            </div>
            <div class="form-group">
                <label for="price">Price (PHP)</label>
                <input type="number" id="price" name="price" placeholder="0.00 PHP" required>
            </div>
            <div class="form-group">
                <label for="fee">Fee (PHP)</label>
                <input type="number" id="fee" name="fee" placeholder="0.00 PHP" readonly>
            </div>
            <div class="form-group">
                <label for="total">Total (PHP)</label>
                <input type="number" id="total" name="total" placeholder="0.00 PHP" readonly>
            </div>
            <button type="submit">Place Order</button>
        </form>
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
    // Fetch Forex Data from Alpha Vantage API
const apiKey = '0GS19P5JKYGR9FHO'; // Replace with your API key
const forexSymbol = 'USDJPY'; // Example: USD to JPY

async function fetchForexData() {
    const url = `https://www.alphavantage.co/query?function=CURRENCY_EXCHANGE_RATE&from_currency=USD&to_currency=PHP&apikey=${apiKey}`;
    try {
        const response = await fetch(url);
        const data = await response.json();
        const exchangeRate = data['Realtime Currency Exchange Rate']['5. Exchange Rate'];
        const change = data['Realtime Currency Exchange Rate']['9. Change'];

        // Update Forex Price and Change
        document.getElementById('forex-price').textContent = `$${exchangeRate} USD`;
        document.getElementById('forex-change').textContent = `${change}%`;
    } catch (error) {
        console.error('Error fetching forex data:', error);
        document.getElementById('forex-price').textContent = 'Error fetching data';
        document.getElementById('forex-change').textContent = '';
    }
}

    // Initialize Chart
const ctx = document.getElementById('forexChart').getContext('2d');
const forexChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'], // Example labels
        datasets: [{
            label: 'USD to PHP',
            data: [50, 51, 52, 53, 54, 55, 56], // Example data
            borderColor: '#4db8ff',
            borderWidth: 2,
            fill: false
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false, // Allow manual adjustment of chart size
        scales: {
            x: {
                display: true,
                title: {
                    display: true,
                    text: 'Time'
                }
            },
            y: {
                display: true,
                title: {
                    display: true,
                    text: 'Price (PHP)'
                }
            }
        }
    }
});

// Fetch Forex Data Every 5 Seconds
setInterval(fetchForexData, 5000);
fetchForexData(); // Initial fetch

// Handle Order Form Submission
let hasUnsavedChanges = false;

document.getElementById('orderForm').addEventListener('input', function() {
    hasUnsavedChanges = true;
});

document.getElementById('orderForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting immediately

    // Ask for confirmation before proceeding
    const confirmOrder = confirm('Are you sure you want to place this order?');
    if (confirmOrder) {
        alert('Order placed successfully!');
        hasUnsavedChanges = false; // Reset the flag
        // You can add logic here to process the order
    } else {
        // If the user cancels, do nothing
        console.log('Order placement canceled.');
    }
});

document.querySelectorAll('nav a').forEach(link => {
    link.addEventListener('click', function(event) {
        if (hasUnsavedChanges) {
            const confirmNavigation = confirm('You have unsaved changes. Are you sure you want to leave?');
            if (!confirmNavigation) {
                event.preventDefault();
            }
        }
    });
});
</script>

</body>
</html>