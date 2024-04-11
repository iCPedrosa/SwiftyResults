<?php
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$formcontent=" From: $name  \n Message: $message";
$subject = "Contact Form";
$mailheader = "From: icpedrosa@swiftyresults.com \r\n";
mail($email, $subject, $formcontent, $mailheader) or die("Error!");
echo "Thank You!";
?>