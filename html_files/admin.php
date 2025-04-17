<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.html");
    exit;
}

?>
<p>Welcome, <?php echo $_SESSION['admin']; ?> | <a href="logout.php">Logout</a></p>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Admin - Update Shipment</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <h2>Update Shipment Status</h2>
    <form action="update.php" method="POST" class="update-form">
        <label>Tracking ID:</label><br />
        <input type="text" name="id" required /><br /><br />

        <label>Status:</label><br />
        <input type="text" name="status" required /><br /><br />

        <label>Estimated Delivery (YYYY-MM-DD):</label><br />
        <input type="date" name="eta" required /><br /><br />

        <button type="submit">Update</button>
    </form>
</body>

</html>
