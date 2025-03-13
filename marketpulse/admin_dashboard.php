<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: ../index.php");
    exit();
}
?>

<h2>Welcome to MarketPulse, <?php echo $_SESSION["admin"]; ?>!</h2>
<a href="php/logout.php">Logout</a>
