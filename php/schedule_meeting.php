<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $datetime = $_POST['datetime'];
    $description = $_POST['description'];
    $icon_file = $_FILES['icon_file'];

    // Função para gerar o conteúdo do arquivo ICO
    function generateIconFile($email, $datetime, $description, $icon_file) {
        // Cabeçalho ICO
        $header = pack('CCCCvv',
            0x00,   // Tipo de arquivo (0x00 para ICO)
            0x01,   // Número de ícones no arquivo (1 para um único ícone)
            0x00,   // Largura (0 para ícone 32x32)
            0x00,   // Altura (0 para ícone 32x32)
            0x01,   // Número de cores na paleta (1 para ícone 32x32)
            0x20    // Tamanho dos dados do ícone em bytes (32x32 = 1024 bytes)
        );

        // Dados do ícone (32x32) - exemplo simples, substitua com seus dados
        $icon_data = "\x00\x00\x01\x00\x01\x00\x10\x10" . // Ícone 32x32 com uma cor
                     str_repeat("\x00", 1024); // Dados de pixels, aqui está vazio

        // Combine o cabeçalho com os dados do ícone
        $icon_content = $header . $icon_data;

        return $icon_content;
    }

    // Gera o conteúdo do arquivo ICO
    $icon_content = generateIconFile($email, $datetime, $description, $icon_file);

    // Cabeçalhos MIME para o e-mail
    $boundary = md5(time());
    $headers = "From: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

    // Corpo do e-mail
    $message_body = "--$boundary\r\n";
    $message_body .= "Content-Type: text/plain; charset=\"UTF-8\"\r\n";
    $message_body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $message_body .= "Email: $email\nDatetime: $datetime\nDescription: $description\r\n\r\n";
    $message_body .= "--$boundary\r\n";
    $message_body .= "Content-Type: application/octet-stream; name=\"icon.ico\"\r\n";
    $message_body .= "Content-Disposition: attachment; filename=\"icon.ico\"\r\n";
    $message_body .= "Content-Transfer-Encoding: base64\r\n";
    $message_body .= "\r\n";
    $message_body .= chunk_split(base64_encode($icon_content))."\r\n";
    $message_body .= "--$boundary--";

    $subject = "Generated ICO File";

    // Envio do e-mail
    try {
        mail("icpedrosa@swiftyresults.com, bernardo.melo@swiftyresults.com, marcus.wagner@swiftyresults.com", $subject, $message_body, $headers);
        header('HTTP/1.1 200 OK');
        echo "E-mail enviado com sucesso!";
    } catch (Exception $ex) {
        echo "Erro ao enviar o e-mail: $ex";
    }
} else {
    echo "Acesso direto não permitido.";
}
?>
