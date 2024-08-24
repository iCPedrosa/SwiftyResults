<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set header to return JSON
header('Content-Type: application/json');

// Function to send JSON response
function send_response($success, $message, $debug = null) {
    $response = ['success' => $success, 'message' => $message];
    if ($debug !== null) {
        $response['debug'] = $debug;
    }
    echo json_encode($response);
    exit;
}

try {
    // Database connection details
    $servername = "localhost";
    $username = "icpedrosa";
    $password = "pedr0sa123@@#!@#";
    $dbname = "SwiftyResults";

    // Check if the request is a POST request
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        throw new Exception("Invalid request method");
    }

    // Get the email and OptedIn values
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $optedIn = isset($_POST['OptedIn']) ? $_POST['OptedIn'] : '';

    // Debug information
    $debug = [
        'raw_email' => $_POST['email'] ?? 'not set',
        'trimmed_email' => $email,
        'email_length' => strlen($email),
        'is_valid_email' => filter_var($email, FILTER_VALIDATE_EMAIL) ? 'true' : 'false',
        'opted_in_value' => $optedIn
    ];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Invalid email format");
    }

    // Validate OptedIn
    if ($optedIn === 'true' || $optedIn === '1') {
        $optedIn = true;
    } elseif ($optedIn === 'false' || $optedIn === '0') {
        $optedIn = false;
    } else {
        throw new Exception("Invalid OptedIn value");
    }

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO newsletter (EmailAddress, OptedIn, CreatedDate) VALUES (?, ?, NOW())");
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }

    // Convert boolean to integer for MySQL
    $optedInInt = $optedIn ? 1 : 0;

    $stmt->bind_param("si", $email, $optedInInt);

    // Execute the statement
    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }

    send_response(true, "Thank you for subscribing to our newsletter!");

} catch (Exception $e) {
    send_response(false, "An error occurred: " . $e->getMessage(), $debug ?? null);
} finally {
    // Close statement and connection if they exist
    if (isset($stmt) && $stmt) {
        $stmt->close();
    }
    if (isset($conn) && $conn) {
        $conn->close();
    }
}
?>