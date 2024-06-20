<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Dados do formulário
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Conteúdo do e-mail
$formcontent = "From: $name\nEmail: $email\nMessage: $message";
$subject = "Contact Form Submission";
$mailheader = "From: $email\r\n";

// Envia o e-mail
try {
    mail("icpedrosa@swiftyresults.com, bernardo.melo@swiftyresults.com, marcus.wagner@swiftyresults.com", $subject, $formcontent, $mailheader);
    echo 'Message sent successfully.';
} catch (Exception $ex) {
    echo "An error occurred: $ex";
    // Pode adicionar mais tratamento de erro aqui se necessário
}

// Código para criação e envio do arquivo Excel
try {
    // Obtém dados do formulário
    $description = $_POST['description'];
    $datetime = $_POST['datetime'];
    $duration = $_POST['duration'] ?? 15;

    // Divide datetime em data e hora
    $date = date('Y-m-d', strtotime($datetime));
    $time = date('H:i:s', strtotime($datetime));

    // Cria uma nova planilha
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Schedule a meeting with us');

    // Define os cabeçalhos
    $sheet->setCellValue('A1', 'Title');
    $sheet->setCellValue('B1', 'Description');
    $sheet->setCellValue('C1', 'Date');
    $sheet->setCellValue('D1', 'Hour');
    $sheet->setCellValue('E1', 'Duration (minutes)');
    $sheet->setCellValue('F1', 'Email'); // Adiciona o cabeçalho do email

    // Adiciona os dados da reunião
    $sheet->setCellValue('A2', 'Consultation with SwiftyResults');
    $sheet->setCellValue('B2', $description);
    $sheet->setCellValue('C2', $date);
    $sheet->setCellValue('D2', $time);
    $sheet->setCellValue('E2', $duration);
    $sheet->setCellValue('F2', $email); // Adiciona o email à célula correspondente

    // Define o nome do arquivo
    $filename = 'Consultation_with_SwiftyResults_schedule.xlsx'; // Nome do arquivo

    // Salva o arquivo temporariamente
    $tempFilePath = tempnam(sys_get_temp_dir(), 'meeting_') . '.xlsx';
    $writer = new Xlsx($spreadsheet);
    $writer->save($tempFilePath);

    // Envia o e-mail com o arquivo anexado
    $mail = new PHPMailer(true);
    
    $mailHost = 'smtp.example.com'; // Substitua pelo seu servidor SMTP
    $mailUsername = 'your-email@example.com'; // Substitua pelo seu email
    $mailPassword = 'your-email-password'; // Substitua pela sua senha de email
    $mailPort = 587; // Porta do servidor SMTP

    $mail->isSMTP();
    $mail->Host = $mailHost;
    $mail->SMTPAuth = true;
    $mail->Username = $mailUsername;
    $mail->Password = $mailPassword;
    $mail->SMTPSecure = 'tls';
    $mail->Port = $mailPort;

    // Define remetente e destinatário
    $mail->setFrom('icpedrosa@swiftyresults.com', 'SwiftyResults'); // Remetente
    $mail->addAddress($email); // Destinatário

    // Conteúdo do e-mail
    $mail->isHTML(true);
    $mail->Subject = 'Your Meeting Schedule';
    $mail->Body    = 'Here is the schedule for your meeting. Please find the attached file for details.';
    $mail->addAttachment($tempFilePath, $filename);

    // Envia o e-mail
    $mail->send();
    echo 'Message has been sent';

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

// Remove o arquivo temporário
unlink($tempFilePath);
?>
