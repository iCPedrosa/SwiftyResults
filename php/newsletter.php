<?php
// Enable error reporting for debugging
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
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$optedIn = isset($_POST['OptedIn']) ? $_POST['OptedIn'] : '';

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    send_response(false, "Invalid email format");
}

// Validate OptedIn
if ($optedIn === null) {
    send_response(false, "Invalid OptedIn value");
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    send_response(false, "Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO newsletter (EmailAddress, OptedIn, CreatedDate) VALUES (?, ?, NOW())");
if (!$stmt) {
    send_response(false, "Prepare failed: " . $conn->error);
}

// Convert boolean to integer for MySQL
$optedInInt = $optedIn ? 1 : 0;

$stmt->bind_param("si", $email, $optedInInt);

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