<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$currDir = dirname(__FILE__);
require $currDir . '/PHPMailer/src/Exception.php';
require $currDir . '/PHPMailer/src/PHPMailer.php';
require $currDir . '/PHPMailer/src/SMTP.php';
require $currDir . '/PHPMailer/src/POP3.php';
$mail = new PHPMailer(true);
  try {
        //Server settings
        $mail->SMTPDebug = 2;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'mail.unibooks.com.ng';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'noreply@unibooks.com.ng';                     // SMTP username
        $mail->Password   = 'UcLLZH7My3v&';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                                  // Enable TLS encryption, [ICODE]ssl[/ICODE] also accepted
        $mail->Port       = 465;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('noreply@unibooks.com.ng', 'Unibooks');
        $mail->addAddress($email, $row['firstname'] .' '.$row['lastname']);     // Add a recipient
        $mail->addAddress($email,$row['firstname'] .' '.$row['lastname']);               // Name is optional
        $mail->addReplyTo('support@unibooks.com.ng');
        // $mail->addCC('noreply@unibooks.com.ng');
        // $mail->addBCC('noreply@unibooks.com.ng');

        // Attachments
        // $mail->addAttachment($currDir . '/faq.php');         // Add attachments
        // $mail->addAttachment($currDir . '/Images/bruce-mars.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Reset Password Link';
        $mail->Body    = $message;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
          $_SESSION['success'] = 'Password reset link sent';
    
      } catch (Exception $e) {
        $_SESSION['error'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

        
      }
    
