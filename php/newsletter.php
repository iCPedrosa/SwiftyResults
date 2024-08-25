<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

function send_response($success, $message, $debug = null) {
    $response = ['success' => $success, 'message' => $message];
    if ($debug !== null) {
        $response['debug'] = $debug;
    }
    echo json_encode($response);
    exit;
}

$debug = [
    'post_data' => $_POST,
    'raw_input' => file_get_contents('php://input'),
    'request_method' => $_SERVER['REQUEST_METHOD'],
    'content_type' => $_SERVER['CONTENT_TYPE'] ?? 'not set',
    'mysqli_available' => extension_loaded('mysqli') ? 'Yes' : 'No',
];

try {
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        throw new Exception("Invalid request method");
    }

    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $optedIn = isset($_POST['OptedIn']) ? $_POST['OptedIn'] : '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Invalid email format");
    }

    $optedIn = ($optedIn === '1' || $optedIn === 1) ? 1 : 0;

    if (!extension_loaded('mysqli')) {
        $log_message = date('Y-m-d H:i:s') . " - Email: $email, OptedIn: $optedIn\n";
        file_put_contents('newsletter_subscriptions.log', $log_message, FILE_APPEND);
        send_response(true, "Thank you for subscribing to our newsletter! (Data logged)");
    } else {
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

        $stmt->bind_param("si", $email, $optedIn);

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $stmt->close();
        $conn->close();

        send_response(true, "Thank you for subscribing to our newsletter!");
    }

} catch (Exception $e) {
    error_log("Newsletter subscription error: " . $e->getMessage());
    send_response(false, "An error occurred: " . $e->getMessage(), $debug);
}
?>