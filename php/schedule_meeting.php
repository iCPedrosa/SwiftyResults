<?php
$name = $_POST['name'];
$email = $_POST['email'];
$datetime = $_POST['datetime'];
$description = $_POST['description'];

$subject = "Schedule Meeting";
$to = "icpedrosa@swiftyresults.com, bernardo.melo@swiftyresults.com, marcus.wagner@swiftyresults.com";
$from_email = $email;

// Função para gerar o conteúdo do arquivo .ics
function generate_ics_file($email, $datetime, $description) {
    $timestamp = strtotime($datetime);
    $start_date = date('Ymd\THis', $timestamp);
    $end_date = date('Ymd\THis', strtotime('+15 minutes', $timestamp));

    $output = "BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//Your Company//NONSGML Event//EN
BEGIN:VEVENT
UID:" . md5(uniqid(mt_rand(), true)) . "@swiftyresults.com
DTSTAMP:" . gmdate('Ymd\THis\Z') . "
DTSTART:$start_date
DTEND:$end_date
SUMMARY:Meeting with $email
DESCRIPTION:$description
END:VEVENT
END:VCALENDAR";

    return $output;
}

// Gerar o conteúdo do arquivo .ics
$ics_content = generate_ics_file($name, $email, $datetime, $description);

// Headers para o email
$headers = "From: $from_email\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/calendar; method=REQUEST; charset=UTF-8\r\n";
$headers .= "Content-Disposition: inline; filename=meeting.ics\r\n";
$headers .= "Content-Transfer-Encoding: 7bit\r\n";

// Enviar o email com o arquivo .ics anexado
try {
    mail($to, $subject, $ics_content, $headers);
    header('HTTP/1.1 200 OK');
    echo "Email sent successfully!";
} catch (Exception $ex) {
    echo "Error: " . $ex->getMessage();
}
?>
