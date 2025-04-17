
<?php
require 'db.php';

// Get form values
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$subject = $_POST['subject'];
$message = trim($_POST['message']);

// Validate
if (!$name || !$email || !$subject || !$message) {
    die("All fields are required.");
}

// Ticket ID generator
$ticket_id = 'SUP' . strtoupper(uniqid());

// Handle attachment
$attachment_path = null;
if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === 0) {
    $upload_dir = 'uploads/';
    $filename = basename($_FILES['attachment']['name']);
    $filepath = $upload_dir . time() . "_" . $filename;

    if (!file_exists($upload_dir))
        mkdir($upload_dir, 0777, true);
    move_uploaded_file($_FILES['attachment']['tmp_name'], $filepath);
    $attachment_path = $filepath;
}

// Save to DB
$stmt = $conn->prepare("INSERT INTO support_requests (ticket_id, name, email, subject, message, attachment) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $ticket_id, $name, $email, $subject, $message, $attachment_path);
$stmt->execute();

// Send email to admin
$to = "support@yourdomain.com";
$subject_email = "New Support Request – $ticket_id";
$body = "Ticket ID: $ticket_id\nName: $name\nEmail: $email\nSubject: $subject\n\nMessage:\n$message";
$headers = "From: no-reply@yourdomain.com";

mail($to, $subject_email, $body, $headers);

// Confirmation
echo "<h3>Thank you! Your support request was submitted.<br>Your Ticket ID: <strong>$ticket_id</strong></h3>";
?>