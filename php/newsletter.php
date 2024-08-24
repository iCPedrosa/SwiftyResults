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

// Capture raw input
$raw_input = file_get_contents('php://input');

// Debug information
$debug = [
    'post_data' => $_POST,
    'get_data' => $_GET,
    'raw_input' => $raw_input,
    'request_method' => $_SERVER['REQUEST_METHOD'],
    'content_type' => $_SERVER['CONTENT_TYPE'] ?? 'not set',
    'http_referer' => $_SERVER['HTTP_REFERER'] ?? 'not set',
    'raw_email' => $_POST['email'] ?? 'not set',
    'raw_opted_in' => $_POST['OptedIn'] ?? 'not set',
    'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'not set',
    'php_version' => PHP_VERSION,
    'mysqli_available' => extension_loaded('mysqli') ? 'Yes' : 'No',
    'loaded_extensions' => implode(', ', get_loaded_extensions()),
];

try {
    // Check if the request is a POST request
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        throw new Exception("Invalid request method");
    }

    // Get the email and OptedIn values
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $optedIn = isset($_POST['OptedIn']) ? $_POST['OptedIn'] : '';

    // Validate email
    // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //     throw new Exception("Invalid email format");
    // }

    // Validate OptedIn
    // if ($optedIn === '1' || $optedIn === '1') {
    //     $optedIn = true;
    // } elseif ($optedIn === '0' || $optedIn === '0') {
    //     $optedIn = false;
    // } else {
    //     throw new Exception("Invalid OptedIn value");
    // }

    // Check if MySQLi is available
    if (!extension_loaded('mysqli')) {
        // MySQLi is not available, so we'll just log the data instead
        $log_message = date('Y-m-d H:i:s') . " - Email: $email, OptedIn: " . ($optedIn ? 'true' : 'false') . "\n";
        file_put_contents('newsletter_subscriptions.log', $log_message, FILE_APPEND);
        send_response(true, "Thank you for subscribing to our newsletter! (Data logged)");
    } else {
        // MySQLi is available, proceed with database insertion
        $servername = "localhost";
        $username = "icpedrosa";
        $password = "pedr0sa123@@#!@#";
        $dbname = "SwiftyResults";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO newsletter (EmailAddress, OptedIn, CreatedDate) VALUES (?, ?, NOW())");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        $optedInInt = $optedIn ? 1 : 0;
        $stmt->bind_param("si", $email, $optedInInt);

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $stmt->close();
        $conn->close();

        send_response(true, "Thank you for subscribing to our newsletter!");
    }

} catch (Exception $e) {
    send_response(false, "An error occurred: " . $e->getMessage(), $debug);
}
?>