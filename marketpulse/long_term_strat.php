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
    <title>Long Term Strategy - MarketPulse</title>
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

<main class="long-term-strategy-container">
    <!-- Centered Title -->
    <div class="pocket-trade-title">
        <h1>Pocket Trade</h1>
    </div>

    <!-- Simulation Amount Display -->
    <div class="simulation-amount-display">
        <p>Your Simulation Amount: <span>₱<?php echo htmlspecialchars($amount); ?></span></p>
    </div>

    <!-- Panel for Content -->
    <div class="simulation-panel">
        <!-- Select Strategies to Simulate -->
        <div class="select-strategies">
            <h2>Select Strategies to Simulate</h2>
            <p>Allocate funds to copy one or more strategy</p>
            <p class="strategy-description">Showing top performing strategies for the selected time period: <?php echo htmlspecialchars($period); ?></p>
        </div>

        <!-- Strategy Cards with Sliders -->
        <div class="strategy-cards">
            <button class="nav-button prev-button">&lt;</button>
            <div class="cards-container">
                <div class="strategy-card">
                    <h3>Legend</h3>
                    <p>Total Net: 11.8%</p>
                    <p>Average Funds: 5.8%</p>
                    <p>Copy Rate: 0.7%</p>
                    <input type="range" min="0" max="100" value="0" class="slider">
                    <p class="allocated-funds">Allocated Funds: ₱<span class="funds-value">0</span></p>
                </div>
                <div class="strategy-card">
                    <h3>Alpha</h3>
                    <p>Total Net: 1.7%</p>
                    <p>Average Funds: 4.6%</p>
                    <p>Copy Rate: 0.3%</p>
                    <input type="range" min="0" max="100" value="0" class="slider">
                    <p class="allocated-funds">Allocated Funds: ₱<span class="funds-value">0</span></p>
                </div>
                <div class="strategy-card">
                    <h3>Jumbo</h3>
                    <p>Total Net: 0.7%</p>
                    <p>Average Funds: 0.6%</p>
                    <p>Copy Rate: 0.2%</p>
                    <input type="range" min="0" max="100" value="0" class="slider">
                    <p class="allocated-funds">Allocated Funds: ₱<span class="funds-value">0</span></p>
                </div>
                <div class="strategy-card">
                    <h3>Omega</h3>
                    <p>Total Net: 2.5%</p>
                    <p>Average Funds: 3.2%</p>
                    <p>Copy Rate: 0.4%</p>
                    <input type="range" min="0" max="100" value="0" class="slider">
                    <p class="allocated-funds">Allocated Funds: ₱<span class="funds-value">0</span></p>
                </div>
                <div class="strategy-card">
                    <h3>Delta</h3>
                    <p>Total Net: 3.1%</p>
                    <p>Average Funds: 2.8%</p>
                    <p>Copy Rate: 0.5%</p>
                    <input type="range" min="0" max="100" value="0" class="slider">
                    <p class="allocated-funds">Allocated Funds: ₱<span class="funds-value">0</span></p>
                </div>
            </div>
            <button class="nav-button next-button">&gt;</button>
        </div>

        <!-- Total Allocated Funds -->
        <div class="total-allocated-funds">
            <p>Total Allocated Funds: ₱<span id="total-funds">0</span></p>
        </div>

        <!-- Simulate Now Button -->
        <div class="simulate-now">
            <button id="simulateNowBtn">Simulate Now</button>
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
    // JavaScript for handling the Simulate Now button
    document.getElementById('simulateNowBtn').addEventListener('click', function() {
        // Collect allocated funds for each strategy
        const allocatedFunds = [];
        const sliders = document.querySelectorAll('.slider');
        sliders.forEach(slider => {
            allocatedFunds.push(slider.value);
        });

        // Redirect to long_term_analysis.php with allocated funds as URL parameters
        const amount = "<?php echo htmlspecialchars($amount); ?>";
        const period = "<?php echo htmlspecialchars($period); ?>";
        const queryParams = new URLSearchParams({
            amount: amount,
            period: period,
            legend: allocatedFunds[0],
            alpha: allocatedFunds[1],
            jumbo: allocatedFunds[2],
            omega: allocatedFunds[3],
            delta: allocatedFunds[4]
        });
        window.location.href = `long_term_analysis.php?${queryParams.toString()}`;
    });

    // JavaScript for handling the next/previous buttons
    const cardsContainer = document.querySelector('.cards-container');
    const prevButton = document.querySelector('.prev-button');
    const nextButton = document.querySelector('.next-button');

    let scrollAmount = 0;
    const scrollStep = 300; // Adjust this value based on card width

    prevButton.addEventListener('click', () => {
        scrollAmount -= scrollStep;
        if (scrollAmount < 0) scrollAmount = 0;
        cardsContainer.scrollTo({
            left: scrollAmount,
            behavior: 'smooth'
        });
    });

    nextButton.addEventListener('click', () => {
        scrollAmount += scrollStep;
        if (scrollAmount > cardsContainer.scrollWidth - cardsContainer.clientWidth) {
            scrollAmount = cardsContainer.scrollWidth - cardsContainer.clientWidth;
        }
        cardsContainer.scrollTo({
            left: scrollAmount,
            behavior: 'smooth'
        });
    });

    // JavaScript for updating allocated funds and total funds
    const sliders = document.querySelectorAll('.slider');
    const totalFundsDisplay = document.getElementById('total-funds');

    sliders.forEach(slider => {
        slider.addEventListener('input', function() {
            const fundsValue = this.nextElementSibling.querySelector('.funds-value');
            const allocatedFunds = (this.value / 100) * <?php echo str_replace(',', '', $amount); ?>;
            fundsValue.textContent = allocatedFunds.toLocaleString();

            // Update total allocated funds
            let totalFunds = 0;
            sliders.forEach(s => {
                totalFunds += (s.value / 100) * <?php echo str_replace(',', '', $amount); ?>;
            });
            totalFundsDisplay.textContent = totalFunds.toLocaleString();
        });
    });
</script>

</body>
</html>