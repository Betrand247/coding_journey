<?php
$conn = new mysqli("localhost", "root", "", "shipxpress");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $conn->real_escape_string($_POST['id']);
$status = $conn->real_escape_string($_POST['status']);
$eta = $conn->real_escape_string($_POST['eta']);

$sql = "UPDATE shipments SET status='$status', eta='$eta' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "<h3>Shipment updated successfully!</h3>";
    echo "<a href='admin.html'>Back to Admin</a>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>