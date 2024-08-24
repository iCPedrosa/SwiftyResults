<?php
// At the very top of the script, add these lines:
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set header to return JSON
header('Content-Type: application/json');

// Function to send JSON response
function send_response($success, $message) {
    echo json_encode(['success' => $success, 'message' => $message]);
    exit;
}

// Database connection details
$servername = "localhost";
$username = "icpedrosa";
$password = "S1ftyR3suls@3412!!";
$dbname = "SwiftyResults";

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    send_response(false, "Invalid request method");
}

// Get the email and OptedIn values
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$optedIn = filter_input(INPUT_POST, 'OptedIn', FILTER_SANITIZE_STRING);

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    send_response(false, "Invalid email format");
}

// Validate OptedIn
if ($optedIn !== 'true') {
    send_response(false, "You must agree to subscribe");
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    send_response(false, "Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO newsletter (email, optedin, createddate) VALUES (?, ?, NOW())");
if (!$stmt) {
    send_response(false, "Prepare failed: " . $conn->error);
}

$stmt->bind_param("ss", $email, $optedIn);

// Execute the statement
if ($stmt->execute()) {
    send_response(true, "Thank you for subscribing to our newsletter!");
} else {
    send_response(false, "Error: " . $stmt->error);
}

// Close statement and connection
$stmt->close();
$conn->close();
?>