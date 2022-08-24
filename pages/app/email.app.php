<?php


$email_to = "bolajiteslim@gmail.com";
$subject = "your book is here";
$message = "dear student here is your study material";

$headers = "From: teslim <bolajiteslim@gmail.com>";

if (mail($email_to, $subject, $message, $headers)) {
    echo 'good';
}else {
    echo 'bad';
}
