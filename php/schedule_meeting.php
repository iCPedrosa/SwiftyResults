<?php
$email = $_POST['email'];
$date = $_POST['date'];
$time = $_POST['time'];
$description = $_POST['description'];

$subject = "Schedule Meeting";
$to = "icpedrosa@swiftyresults.com, bernardo.melo@swiftyresults.com, marcus.wagner@swiftyresults.com";
$from_email = "no-reply@swiftyresults.com";  // Você pode usar um email de envio fixo

// Função para validar e formatar a data e hora
function validate_and_format_datetime($date, $time) {
    $datetime = new DateTime("$date $time");
    $hour = (int)$datetime->format('H');
    if ($hour < 8 || $hour >= 17) {
        throw new Exception("A hora deve estar entre 8AM e 5PM.");
    }
    return $datetime->format('m/d/Y h:i A');
}

// Função para formatar a data e hora no formato correto para o arquivo .ics
function format_ics_datetime($datetime) {
    $datetime = new DateTime($datetime);
    return $datetime->format('Ymd\THis');
}

// Função para gerar o conteúdo do arquivo .ics
function generate_ics_file($to, $email, $datetime, $description) {
    $start_date = format_ics_datetime($datetime);
    $end_date = (new DateTime($datetime))->modify('+15 minutes')->format('Ymd\THis');

    // Lista de participantes (destinatários internos da SwiftyResults)
    $attendees = "";
    foreach (explode(', ', $to) as $attendee) {
        $attendees .= "ATTENDEE;CN=$attendee;RSVP=TRUE:mailto:$attendee\r\n";
    }

    $output = "BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//Swifty Results//NONSGML Event//EN
BEGIN:VEVENT
UID:" . md5(uniqid(mt_rand(), true)) . "@swiftyresults.com
DTSTAMP:" . gmdate('Ymd\THis\Z') . "
DTSTART:$start_date
DTEND:$end_date
SUMMARY:Meeting with SwiftyResults.com
ORGANIZER;CN=Customer:mailto:$email
$attendees
DESCRIPTION:$description
END:VEVENT
END:VCALENDAR";

    return $output;
}

try {
    // Validar e formatar a data e hora
    $formatted_datetime = validate_and_format_datetime($date, $time);

    // Gerar o conteúdo do arquivo .ics
    $ics_content = generate_ics_file($to, $email, "$date $time", $description);

    // Headers para o email
    $headers = "From: $from_email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/calendar; method=REQUEST; charset=UTF-8\r\n";
    $headers .= "Content-Disposition: inline; filename=meeting.ics\r\n";
    $headers .= "Content-Transfer-Encoding: 7bit\r\n";

    // Enviar o email com o arquivo .ics anexado
    mail($to . ', ' . $email, $subject, $ics_content, $headers);
    header('HTTP/1.1 200 OK');
    echo "Email sent successfully!";
} catch (Exception $ex) {
    header('HTTP/1.1 400 Bad Request');
    echo "Error: " . $ex->getMessage();
}
?>
