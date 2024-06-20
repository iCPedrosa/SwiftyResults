<?php
$email = $_POST['email'];
$datetime = $_POST['datetime'];
$description = $_POST['description'];

$subject = "Schedule Meeting";
$to = "icpedrosa@swiftyresults.com, bernardo.melo@swiftyresults.com, marcus.wagner@swiftyresults.com";
$from_email = "no-reply@swiftyresults.com";  // Você pode usar um email de envio fixo
$headers_to = $to . ", " . $email;  // Inclui o cliente na lista de destinatários

// Função para formatar a data e hora no formato correto para o arquivo .ics
function format_ics_datetime($datetime) {
    $datetime = new DateTime($datetime);
    return $datetime->format('Ymd\THis');
}

// Função para gerar o conteúdo do arquivo .ics para Outlook
function generate_ics_file_outlook($to, $email, $datetime, $description) {
    $start_date = format_ics_datetime($datetime);
    $end_date = (new DateTime($datetime))->modify('+15 minutes')->format('Ymd\THis');

    // Lista de participantes (destinatários internos da SwiftyResults)
    $attendees = "";
    foreach (explode(', ', $to) as $attendee) {
        $attendees .= "ATTENDEE;CN=SwiftyResults;RSVP=TRUE:mailto:$attendee\r\n";
    }

    $output = "BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//Swifty Results//NONSGML Event//EN
METHOD:REQUEST
BEGIN:VEVENT
UID:" . md5(uniqid(mt_rand(), true)) . "@swiftyresults.com
DTSTAMP:" . gmdate('Ymd\THis\Z') . "
DTSTART:$start_date
DTEND:$end_date
SUMMARY:Meeting with SwiftyResults.com
ORGANIZER;CN=SwiftyResults:mailto:no-reply@swiftyresults.com
$attendees
DESCRIPTION:$description
STATUS:CONFIRMED
SEQUENCE:0
TRANSP:OPAQUE
END:VEVENT
END:VCALENDAR";

    return $output;
}

// Função para gerar o conteúdo do arquivo .ics para Google Calendar
function generate_ics_file_google($to, $email, $datetime, $description) {
    $start_date = format_ics_datetime($datetime);
    $end_date = (new DateTime($datetime))->modify('+15 minutes')->format('Ymd\THis');

    // Lista de participantes (destinatários internos da SwiftyResults)
    $attendees = "";
    foreach (explode(', ', $to) as $attendee) {
        $attendees .= "ATTENDEE;CN=SwiftyResults;RSVP=TRUE:mailto:$attendee\r\n";
    }

    $output = "BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//Swifty Results//NONSGML Event//EN
CALSCALE:GREGORIAN
METHOD:REQUEST
BEGIN:VEVENT
UID:" . md5(uniqid(mt_rand(), true)) . "@swiftyresults.com
DTSTAMP:" . gmdate('Ymd\THis\Z') . "
DTSTART:$start_date
DTEND:$end_date
SUMMARY:Meeting with SwiftyResults.com
ORGANIZER;CN=SwiftyResults:mailto:no-reply@swiftyresults.com
$attendees
DESCRIPTION:$description
STATUS:CONFIRMED
SEQUENCE:0
TRANSP:OPAQUE
END:VEVENT
END:VCALENDAR";

    return $output;
}

// Verificar o domínio do email do cliente
if (strpos($email, '@gmail.com') !== false) {
    $ics_content = generate_ics_file_google($to, $email, $datetime, $description);
} else {
    $ics_content = generate_ics_file_outlook($to, $email, $datetime, $description);
}

// Headers para o email
$headers = "From: $from_email\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/calendar; method=REQUEST; charset=UTF-8\r\n";
$headers .= "Content-Disposition: inline; filename=meeting.ics\r\n";
$headers .= "Content-Transfer-Encoding: 7bit\r\n";

// Enviar o email com o arquivo .ics anexado
try {
    mail($headers_to, $subject, $ics_content, $headers);
    header('HTTP/1.1 200 OK');
    echo "Email sent successfully!";
} catch (Exception $ex) {
    echo "Error: " . $ex->getMessage();
}
?>
