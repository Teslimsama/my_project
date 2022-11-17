<?php 
// connect to database
include('config/database.php');


nclude "assets/includes/session.php";
$errors = [];
$user_id = "";



/*
  Accept email of user whose password is to be reset
  Send email to user to reset their password
*/
if (isset($_POST['reset-password'])) {
  $email = mysqli_real_escape_string($db_connect, $_POST['email']);
  // ensure that the user exists on our system
  $query = "SELECT email FROM unibooker WHERE email='$email'";
  $results = mysqli_query($db_connect, $query);

  if (empty($email)) {
    array_push($errors, "Your email is required");
  }else if(mysqli_num_rows($results) <= 0) {
    array_push($errors, "Sorry, no user exists on our system with that email");
  }
  // generate a unique random token of length 100
  $token = bin2hex(random_bytes(50));

  if (count($errors) == 0) {
    // store token in the password-reset database table against the user's email
    $sql = "INSERT INTO password_reset(email, token) VALUES ('$email', '$token')";
    $results = mysqli_query($db_connect, $sql);

    // Send email to user with the token in a link they can click on
    define("SITE_NAME", "unibooks.com.ng"); // I added that
    $to = $email;
    $subject = "Reset your password on " . SITE_NAME;
    // $link = '<a href="\new_pass.php?token='. $token .'">'.'link'.'</a>';
    // $msg = 'Hi there, click on this '.$link.'to reset your password on our site';
    $subject = "Thank you for registering to ";


    $mail_content = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>

    <div>
            <p>' . $user->first_name . ' ' . $user->lastname_name . ', thank you for registering to ' . SITE_NAME . '.</p>
            <p>Please click the following link to proceed to the Questionnaire "<a href ="\new_pass.php?token='. $token .'">www.example.com</a>"</p>


    </div>
    </body>
    </html>';

    $msg = wordwrap($msg,70);
    $headers = "From: bolajiteslim07@gmail.com";
    mail($to, $subject, $msg, $headers);
    header('location: pending.php?email=' . $email);
  }
}

// ENTER A NEW PASSWORD
if (isset($_POST['new_password'])) {
  $new_pass = mysqli_real_escape_string($db_connect, $_POST['new_pass']);
  $new_pass_c = mysqli_real_escape_string($db_connect, $_POST['new_pass_c']);

  // Grab to token that came from the email link
  $token = $_GET['token'];
  if (empty($new_pass) || empty($new_pass_c)) array_push($errors, "Password is required");
  if ($new_pass !== $new_pass_c) array_push($errors, "Password do not match");
  if (count($errors) == 0) {
    // select email address of user from the password_reset table 
    $sql = "SELECT email FROM password_reset WHERE token='$token' LIMIT 1";
    $results = mysqli_query($db_connect, $sql);
    $email = mysqli_fetch_assoc($results)['email'];

    if ($email) {
      $new_pass = md5($new_pass);
      $sql = "UPDATE unibooker SET password='$new_pass' WHERE email='$email'";
      $results = mysqli_query($db_connect, $sql);
      header('location: ../Signup');
    }
  }
}
?>