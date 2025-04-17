<?php
session_start();

$conn = new mysqli("localhost", "root", "", "shipxpress");

if ($conn->connect_error) {
  die("Database connection failed.");
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM admins WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $admin = $result->fetch_assoc();
  if (password_verify($password, $admin['password'])) {
    $_SESSION['admin'] = $admin['username'];
    header("Location: admin.php");
    exit;
  }
}

echo "<h3>Invalid login. <a href='login.html'>Try again</a></h3>";
$conn->close();
?>
