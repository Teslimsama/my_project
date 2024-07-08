<?php
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

$currDir = dirname(__FILE__);
// require $currDir . '/PHPMailer/src/Exception.php';
// require $currDir . '/PHPMailer/src/PHPMailer.php';
// require $currDir . '/PHPMailer/src/SMTP.php';
// require $currDir . '/PHPMailer/src/POP3.php';
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
      $message = "Dear ".$row['firstname'].' '.$row['lastname'].",<br><br>Please click the link below to reset your password:<br><br>";
      $message .= "<a href='https://unibooks.com.ng/password_reset.php?email=".$email."&code=".$code."'>Reset Password</a><br><br>";
      $message .= "Thank you.<br>";
      $message .= "Unibooks Team<br>";

      $headers  = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-Type: text/html; charset=ISO-8859-1' . "\r\n";
      $headers .= 'From: Unibooks <noreply@unibooks.com.ng>' . "\r\n";
      
      $move= header('location: forgotten_password.php');

      include $currDir .'/email.app.php';
      $move;
    } catch (PDOException $e) {
      $_SESSION['error'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
       $move;
    
    }
  } else {
    $_SESSION['error'] = 'Email not found';
     $move;
     header('location: forgotten_password.php');
  }

  $pdo->close();
} else {
  $_SESSION['error'] = 'Input email associated with account';
//   $move;
header('location: forgotten_password.php');
}
