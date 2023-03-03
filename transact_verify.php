<?php
include "session.php";

$user_id = $user['id'];

$ref = $_GET['status'];
if ($ref == "") {
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}

// $stmt = $conn->prepare("SELECT * FROM project WHERE id=:id");
// $stmt->execute(['id' => $_SESSION['admin']]);
// $admin = $stmt->fetch();
// $status = $_GET['status'];

if ($_GET['status'] === 'successful') {
  $reference = $_GET['tx_ref'];
  $status = 'success';
  // $amount = $;

  // $book = $;
  $lname = $user['lastname'];
  $fname = $user['firstname'];
  $fullname = $fname . ' ' . $lname;
  $Cus_email = $user['email'];
  date_default_timezone_set('Africa/lagos');
  $Date_time = date('m/d/Y h:i:s a', time());



  $stmt = $conn->prepare("INSERT INTO payments (customerid, status, reference, fullname, date, email) VALUES(:customerid, :status,  :reference, :fullname, :date, :email)");
  $stmt->execute(array(
    ':customerid' => $user_id,
    ':status' => $status,
    ':reference' => $reference,
    ':fullname' => $fullname,
    ':date' => $Date_time,
    ':email' => $Cus_email
  ));
  //  ,   ':book' => $book, :book,book
  // Retrieve email associated with payment from unibooker table
  $stmt = $conn->prepare('SELECT email FROM unibooker WHERE id = ?');
  $stmt->execute([$user_id]);
  $row = $stmt->fetch();
  $email = $row['email'];

  // If email is found in unibooker table, generate unique code, update code column, and send password reset email
  if ($email) {
    $code = uniqid();
    $stmt = $conn->prepare('UPDATE unibooker SET code = ? WHERE id = ?');
    $stmt->execute([$code, $user_id]);

    // Send password reset email
    $to = $email;
    $subject = 'Password reset link';
    $message = "Please click on this link to reset your password: https://example.com/reset_password.php?code=$code";
    $headers = 'From: webmaster@example.com' . "\r\n" . 'Reply-To: webmaster@example.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
    if (mail($to, $subject, $message, $headers)) {
      echo 'Email not found';
    }
  } else {
    // If email not found in unibooker table, set error message in session and redirect to pass page
    $_SESSION['error'] = 'Email not found';

    header('Location: pass.php');
    exit;
  }
} 
?>

