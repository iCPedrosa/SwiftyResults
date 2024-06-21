<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturando e sanitizando os dados do formulário
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Verificando se todos os campos estão preenchidos
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Configurações básicas do email
        $to = 'icpedrosa@swiftyresults.com, bernardo.melo@swiftyresults.com, marcus.wagner@swiftyresults.com';
        $subject = 'Mensagem do Formulário de Contato';
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/plain; charset=utf-8\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        // Corpo do email
        $email_body = "From: $name\n";
        $email_body .= "Email: $email\n";
        $email_body .= "Message:\n$message\n";

        // Envio do email
        if (mail($to, $subject, $email_body, $headers)) {
            http_response_code(200);
            echo json_encode(array('status' => 'success', 'message' => 'Your message has been sent. We will get back to you via email soon. Thank you!'));
        } else {
            http_response_code(500);
            echo json_encode(array('status' => 'error', 'message' => 'Error sending message. Please try again later.'));
        }
    } else {
        http_response_code(400);
        echo json_encode(array('status' => 'error', 'message' => 'Please fill in all fields.'));
    }
} else {
    http_response_code(403);
    echo json_encode(array('status' => 'error', 'message' => 'Forbidden access.'));
}
?>
