<?php
$conn = new mysqli("localhost", "root", "", "shipxpress");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>