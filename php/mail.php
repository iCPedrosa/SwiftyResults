<?php
function isValidEmail($email) {

    return preg_match('/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z]{2,}$/i', $email);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    
    if (!empty($name) && !empty($email) && !empty($message) && isValidEmail($email)) {
        $formcontent = "From: $name \nEmail: $email \nMessage: $message";
        $subject = "Contact Form";
        $mailheader = "From: icpedrosa@swiftyresults.com \r\n";

        try {
            mail("icpedrosa@swiftyresults.com, bernardo.melo@swiftyresults.com, marcus.wagner@swiftyresults.com", $subject, $formcontent, $mailheader);
            header('HTTP/1.1 200 OK');
            echo "Your message has been sent successfully.";
        } catch (Exception $ex) {
            
            echo "Error: " . $ex->getMessage();
        }
    } else {
        
        echo "Please fill in all fields correctly with a valid email address.";
    }
} else {
    echo "Invalid request method.";
}

/*O que foi melhorado:
Função isValidEmail:

Foi criada a função isValidEmail($email) que usa uma expressão regular para validar o email.
A expressão regular verifica se o email segue o formato padrão, incluindo a presença do @, . e outros requisitos básicos de um endereço de email válido.
Verificação do email:

Agora, além de verificar se o campo de email não está vazio, o código também verifica se ele é um endereço de email válido com base na regex.
Explicação da Expressão Regular:
^[A-Za-z0-9._%+-]+: Começa com uma combinação de letras, números e certos caracteres permitidos (., _, %, +, -).
@[A-Za-z0-9.-]+: Seguido por um @ e um domínio (que pode conter letras, números, pontos e hifens).
\.[A-Z]{2,}$: Finaliza com um ponto seguido por uma sequência de pelo menos duas letras (representando o TLD, como .com, .net).
Essa abordagem garante que o email inserido tenha um formato razoavelmente válido, cobrindo a maioria dos casos comuns. */



?>
