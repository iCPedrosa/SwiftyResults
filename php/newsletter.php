<?php
// newsletter.php

// Database connection details
$servername = "localhost";
$username = "icpedrosa";
$password = "S1ftyR3suls@3412!!";
$dbname = "SwiftyResults";

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email and OptedIn values
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $optedIn = filter_input(INPUT_POST, 'OptedIn', FILTER_SANITIZE_STRING);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    // Validate OptedIn
    if ($optedIn !== 'true') {
        echo "You must agree to subscribe";
        exit;
    }

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO newsletter (email, opted_in, subscription_date) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $email, $optedIn);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Thank you for subscribing to our newsletter!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();

} else {
    // If it's not a POST request, return an error
    echo "Invalid request method";
}
?>