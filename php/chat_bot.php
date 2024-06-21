<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coletando dados do chat
    $message = $_POST['chatMessage'];

    // Configurações de email
    $to = 'seuemail@exemplo.com'; // Altere para seu endereço de email
    $subject = 'Mensagem do Chat';
    $headers = "From: chat@example.com\r\n";
    $headers .= "Reply-To: chat@example.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Corpo da mensagem
    $email_body = "Mensagem do Chat:\n$message\n";

    // Enviando o email
    if (mail($to, $subject, $email_body, $headers)) {
        echo json_encode(array('success' => true, 'message' => 'Mensagem enviada com sucesso!'));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Erro ao enviar mensagem.'));
    }
} else {
    header('HTTP/1.1 403 Forbidden');
    echo "Acesso proibido.";
}
?>
