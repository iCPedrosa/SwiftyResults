<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Verifica se todos os campos foram preenchidos
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Configurações de email
        $to = 'icpedrosa@swiftyresults.com, bernardo.melo@swiftyresults.com, marcus.wagner@swiftyresults.com';
        $subject = 'Mensagem do Chat';
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/plain; charset=utf-8\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        // Corpo da mensagem
        $email_body = "From: $name\n";
        $email_body .= "Email: $email\n";
        $email_body .= "Message:\n$message\n";

        // Enviando o email
        if (mail($to, $subject, $email_body, $headers)) {
            header('HTTP/1.1 200 OK');
            echo "Your message has been sent. We will get back to you via email. Thank you!";
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo "Error sending message.";
        }
    } else {
        header('HTTP/1.1 400 Bad Request');
        echo "Please fill in all fields.";
    }
} else {
    header('HTTP/1.1 403 Forbidden');
    echo "Access forbidden.";
}
?>
