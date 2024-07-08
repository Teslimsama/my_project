<?php if (!defined('PREPEND_PATH')) define('PREPEND_PATH', '../'); ?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;	
$currDir=dirname(__FILE__);
require $currDir.'/PHPMailer/src/Exception.php';
require $currDir.'/PHPMailer/src/PHPMailer.php';
require $currDir.'/PHPMailer/src/SMTP.php';
require $currDir.'/PHPMailer/src/POP3.php';
 
// Instantiation and passing [ICODE]true[/ICODE] enables exceptions
$mail = new PHPMailer(true);
 
try {
    //Server settings
    $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.unibooks.com.ng';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'info@unibooks.com.ng';                     // SMTP username
    $mail->Password   = 'Work@1234567890';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                                  // Enable TLS encryption, [ICODE]ssl[/ICODE] also accepted
    $mail->Port       = 465;                                    // TCP port to connect to
 
    //Recipients
    $mail->setFrom('info@unibooks.com.ng', 'Mailer');
    $mail->addAddress('bolajiteslim07@gmail.com', 'Joe User');     // Add a recipient
    $mail->addAddress('bolajiteslim07@gmail.com');               // Name is optional
    $mail->addReplyTo('info@unibooks.com.ng', 'Information');
    // $mail->addCC('info@unibooks.com.ng');
    // $mail->addBCC('info@unibooks.com.ng');
 
    // Attachments
    $mail->addAttachment($currDir.'/faq.php');         // Add attachments
    $mail->addAttachment($currDir.'/Images/bruce-mars.jpg');    // Optional name
 
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
 
    $mail->send();
    echo 'Message has been sent';
 
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}