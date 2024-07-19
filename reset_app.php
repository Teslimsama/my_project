<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Include session handling
include 'session.php';

if (isset($_POST['reset'])) {
  $email = $_POST['email'];

  // Database connection
  $conn = $pdo->open();

  // Check if the email exists in the database
  $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM unibooker WHERE email=:email");
  $stmt->execute(['email' => $email]);
  $row = $stmt->fetch();

  if ($row['numrows'] > 0) {
    // Generate code
    $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = substr(str_shuffle($set), 0, 15);
    try {
      // Update code in the database
      $stmt = $conn->prepare("UPDATE unibooker SET code=:code WHERE id=:id");
      $stmt->execute(['code' => $code, 'id' => $row['id']]);

      // Prepare the email
      $mail = new PHPMailer(true);
      try {
        // Server settings
        // $mail->SMTPDebug = 2;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.unibooks.com.ng';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'info@unibooks.com.ng';                     // SMTP username
        $mail->Password   = 'xxxxxxx';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                                  // Enable TLS encryption, [ICODE]ssl[/ICODE] also accepted
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom('noreply@unibooks.com.ng', 'Unibooks.com.ng');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Link';
        $mail->Body    = "Dear " . $row['firstname'] . ' ' . $row['lastname'] . ",<br><br>Please click the link below to reset your password:<br><br>";
        $mail->Body   .= "<a href='https://unibooks.com.ng/password_reset.php?email=" . $email . "&code=" . $code . "'>Reset Password</a><br><br>";
        $mail->Body   .= "Thank you.<br>";
        $mail->Body   .= "Unibooks Team<br>";

        // Send the email
        $mail->send();
        $_SESSION['success'] = 'Password reset link has been sent to your email.';
        header('Location: forgotten_password.php');
        exit();
      } catch (Exception $e) {
        $_SESSION['error'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        header('Location: forgotten_password.php');
        exit();
      }
    } catch (PDOException $e) {
      $_SESSION['error'] = 'Database error: ' . $e->getMessage();
      header('Location: forgotten_password.php');
      exit();
    }
  } else {
    $_SESSION['error'] = 'Email not found';
    header('Location: forgotten_password.php');
    exit();
  }

  $pdo->close();
} else {
  $_SESSION['error'] = 'Input email associated with account';
  header('Location: forgotten_password.php');
  exit();
}
