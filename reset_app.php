<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$currDir = dirname(__FILE__);
require $currDir . '/PHPMailer/src/Exception.php';
require $currDir . '/PHPMailer/src/PHPMailer.php';
require $currDir . '/PHPMailer/src/SMTP.php';
require $currDir . '/PHPMailer/src/POP3.php';
include 'session.php';

if (isset($_POST['reset'])) {
  $email = $_POST['email'];

  $conn = $pdo->open();

  $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM unibooker WHERE email=:email");
  $stmt->execute(['email' => $email]);
  $row = $stmt->fetch();

  if ($row['numrows'] > 0) {
    //generate code
    $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = substr(str_shuffle($set), 0, 15);
    try {
      $stmt = $conn->prepare("UPDATE unibooker SET code=:code WHERE id=:id");
      $stmt->execute(['code' => $code, 'id' => $row['id']]);

      // email message
      $to = $email;
      $subject = 'Password Reset Link';
      $message = "Dear ".$row['firstname'].",<br><br>Please click the link below to reset your password:<br><br>";
      $message .= "<a href='http://localhost/my_project/password_reset.php?email=".$email."&code=".$code."'>Reset Password</a><br><br>";
      $message .= "Thank you.<br>";
      $message .= "Unibooks Team<br>";

      $headers  = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-Type: text/html; charset=ISO-8859-1' . "\r\n";
      $headers .= 'From: Unibooks <noreply@unibooks.com.ng>' . "\r\n";

      // send email
      // if (mail($to, $subject, $message, $headers)) {
      //   $_SESSION['success'] = 'Password reset link sent';'Reset Password Link'
      // } else {
      //   $_SESSION['error'] = 'Message could not be sent. Please try again later.';
      // }
      // Instantiation and passing [ICODE]true[/ICODE] enables exceptions
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
        $mail->addAddress($email, $row['firstname']);     // Add a recipient
        $mail->addAddress($email, $row['firstname']);               // Name is optional
        $mail->addReplyTo('noreply@unibooks.com.ng');
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
        // echo 'Message has been sent';
          $_SESSION['success'] = 'Password reset link sent';'Reset Password Link';
      } catch (Exception $e) {
        $_SESSION['error'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
    } catch (PDOException $e) {
      $_SESSION['error'] = $e->getMessage();
    }
  } else {
    $_SESSION['error'] = 'Email not found';
  }

  $pdo->close();
} else {
  $_SESSION['error'] = 'Input email associated with account';
}

header('location: forgotten_password.php');
