<?php
require 'db.php';

$origin = $_POST['origin'];
$destination = $_POST['destination'];
$weight = floatval($_POST['weight']);
$type = $_POST['type'];

switch ($type) {
    case 'standard':
        $rate = 1.5;
        break;
    case 'express':
        $rate = 2.5;
        break;
    case 'overnight':
        $rate = 3.5;
        break;
    default:
        $rate = 2.0;
}

$cost = round($weight * $rate, 2);

// Save to DB
$stmt = $conn->prepare("INSERT INTO quotes (origin, destination, weight, type, estimated_cost) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssdss", $origin, $destination, $weight, $type, $cost);
$stmt->execute();

echo json_encode([
    "success" => true,
    "cost" => $cost
]);
?>