<?php
 // Certifique-se de que o caminho esteja correto

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Configurações do servidor de e-mail
$mailHost = 'smtp.example.com'; // Substitua pelo seu servidor SMTP
$mailUsername = 'your-email@example.com'; // Substitua pelo seu email
$mailPassword = 'your-email-password'; // Substitua pela sua senha de email
$mailPort = 587; // Porta do servidor SMTP

// Define o título automaticamente
$title = 'Consultation with SwiftyResults';

// Obtém dados do formulário
$description = $_POST['description'];
$datetime = $_POST['datetime'];
$email = $_POST['email']; // Adiciona a obtenção do email do formulário
$duration = $_POST['duration'] ?? 15; // Define a duração padrão como 15 minutos

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
$sheet->setCellValue('A2', $title);
$sheet->setCellValue('B2', $description);
$sheet->setCellValue('C2', $date);
$sheet->setCellValue('D2', $time);
$sheet->setCellValue('E2', $duration);
$sheet->setCellValue('F2', $email); // Adiciona o email à célula correspondente

// Define o nome do arquivo
$filename = $title . '_schedule_meeting.xlsx'; // Inclui o título no nome do arquivo

// Salva o arquivo temporariamente
$tempFilePath = tempnam(sys_get_temp_dir(), 'meeting_') . '.xlsx';
$writer = new Xlsx($spreadsheet);
$writer->save($tempFilePath);

// Envia o e-mail com o arquivo anexado
$mail = new PHPMailer(true);

try {
   
    $mail->isSMTP();
    $mail->Host = $mailHost;
    $mail->SMTPAuth = true;
    $mail->Username = $mailUsername;
    $mail->Password = $mailPassword;
    $mail->SMTPSecure = 'tls';
    $mail->Port = $mailPort;

   
    $mail->setFrom('icpedrosa@swiftyresults.com', 'bernardo.melo@swiftyresults.com'); // Substitua pelo seu email e nome
    $mail->addAddress($email); // Adiciona o endereço de e-mail do destinatário

    // Conteúdo do e-mail
    $mail->isHTML(true);
    $mail->Subject = 'Your Meeting Schedule';
    $mail->Body    = 'Here is the schedule for your meeting. Please find the attached file for details.';
    $mail->addAttachment($tempFilePath, $filename);

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

// Remove o arquivo temporário
unlink($tempFilePath);

// Envia o arquivo para download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
