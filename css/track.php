<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "shipxpress");

if ($conn->connect_error) {
  http_response_code(500);
  echo json_encode(["error" => "Database connection failed."]);
  exit;
}

if (!isset($_GET['id'])) {
  http_response_code(400);
  echo json_encode(["error" => "Missing tracking ID."]);
  exit;
}

$id = $conn->real_escape_string($_GET['id']);

$sql = "SELECT * FROM shipments WHERE id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo json_encode($result->fetch_assoc());
} else {
  http_response_code(404);
  echo json_encode(["error" => "Tracking number not found."]);
}

$conn->close();
?>
