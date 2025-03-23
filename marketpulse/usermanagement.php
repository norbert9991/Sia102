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
    <title>User Management - MarketPulse</title>
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
            <li><a href="usermanagement.php" class="active">User Management</a></li>
            <li><a href="portfolio.php">Portfolio</a></li>
        </ul>
    </nav>
    <div class="user-profile">
        <i class="fa fa-user-circle"></i> 
        <span><?php echo $_SESSION["username"]; ?></span>
        <a href="php/logout.php" class="logout-btn">Logout</a>
    </div>
</header>

<!-- User Management Content -->
<div class="user-management-container">
    <!-- Top Section: Input and Boxes -->
    <div class="user-management-top">
        <!-- Left Side: Text Input -->
        <div class="input-section">
            <h2>User Management</h2>
            <p>User Management provides tools and insights to help administrators effectively manage users in the system.</p>
            <form>
                <input type="text" placeholder="Search users..." />
                <button type="submit">Search</button>
            </form>
        </div>

        <!-- Right Side: Quick Actions Box -->
        <div class="info-box">
            <h3>Quick Actions</h3>
            <ul>
                <li><a href="#">Create New User</a></li>
                <li><a href="#">Manage Permissions</a></li>
            </ul>
        </div>

        <!-- Right Side: Total Users Box -->
        <div class="info-box">
            <h3>Total Users</h3>
            <p class="total-users">1,234</p> <!-- Example number -->
        </div>
    </div>

    <!-- Bottom Section: Big Box (Table) -->
    <div class="user-management-bottom">
        <h3>User List</h3>
        <table>
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th> <!-- Checkbox for selecting all rows -->
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date Created</th>
                    <th>Date Modified</th>
                    <th>Last Login Date</th>
                    <th>Status</th>
                    <th>Actions</th> <!-- New column for actions -->
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="checkbox" class="user-checkbox"></td> <!-- Checkbox for each row -->
                    <td>Juan</td>
                    <td>juang@mail.com</td>
                    <td>2023-10-01</td>
                    <td>2023-10-05</td>
                    <td>2023-10-10</td>
                    <td>Active</td>
                    <td>
                        <button class="edit-btn">Edit</button>
                        <button class="delete-btn">Delete</button>
                    </td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
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

<!-- JavaScript for Select All Checkbox -->
<script>
    document.getElementById('select-all').addEventListener('change', function () {
        const checkboxes = document.querySelectorAll('.user-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
</script>

</body>
</html>