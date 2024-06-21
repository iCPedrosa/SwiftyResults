<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Replace with your email address or comma-separated list of addresses
    $to = 'icpedrosa@swiftyresults.com, bernardo.melo@swiftyresults.com, marcus.wagner@swiftyresults.com';
    $subject = 'Mensagem do Chat';
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Email body
    $email_body = "From: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Message:\n$message\n";

    // Sending email
    if (mail($to, $subject, $email_body, $headers)) {
        $response = array(
            'status' => 'success',
            'message' => 'Your message has been sent. We will get back to you via email. Thank you!'
        );
        http_response_code(200);
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Error sending message.'
        );
        http_response_code(500);
    }
    echo json_encode($response);
} else {
    http_response_code(403);
    echo json_encode(array('message' => 'Access forbidden.'));
}
?>
