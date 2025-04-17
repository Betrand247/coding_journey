<?php
require 'db.php';

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$message = trim($_POST['message']);

// Basic validation
if (!$name || !$email || !$message || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<h3>Invalid input. <a href='contact.html'>Go back</a></h3>";
    exit;
}

// Save to database
$stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $message);

if ($stmt->execute()) {
    // ✅ Optional: Send email to admin
    $to = "admin@yourdomain.com";  // Change this to your actual email
    $subject = "New Contact Message from $name";
    $body = "Name: $name\nEmail: $email\nMessage:\n$message";
    $headers = "From: contact@yourdomain.com";  // Use your server's email

    mail($to, $subject, $body, $headers);

    echo "<h3>Message sent! We'll get back to you soon.</h3>";
} else {
    echo "<h3>Failed to send message. Please try again later.</h3>";
}
?>