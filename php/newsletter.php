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

    $email = isset($_POST['emailaddy']) ? trim($_POST['emailaddy']) : '';
    $optedIn = isset($_POST['OptedIn']) ? $_POST['OptedIn'] : '';

    $debug['received_email'] = $email;
    $debug['received_opted_in'] = $optedIn;

    if (empty($email)) {
        throw new Exception("Email is empty");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Invalid email format: " . $email);
    }

    $optedIn = ($optedIn === '1' || $optedIn === 1) ? 1 : 0;

    // ... (rest of the code remains the same)

} catch (Exception $e) {
    error_log("Newsletter subscription error: " . $e->getMessage());
    send_response(false, $e->getMessage(), $debug);
}
?>