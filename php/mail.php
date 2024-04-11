<?php
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$formcontent=" From: $name  \n Message: $message";
$subject = "Contact Form";
$mailheader = "From: icpedrosa@swiftyresults.com \r\n";

try {
    mail($email, $subject, $formcontent, $mailheader) or die("Error!");
} catch (Exception $ex) {
	// jump to this part
	// if an exception occurred
    echo "$ex";
    
}

echo "Thank You!";
?>