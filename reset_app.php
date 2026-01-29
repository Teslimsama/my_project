<?php
// Include session handling and email helper
include 'session.php';
require_once 'email_helper.php';

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

      // Check if email is configured
      if (!isEmailConfigured()) {
        $_SESSION['error'] = 'Email service is not configured. Please contact the administrator.';
        header('Location: forgotten_password.php');
        exit();
      }

      // Send password reset email using helper function
      $result = sendPasswordResetEmail(
        $email,
        $row['firstname'],
        $row['lastname'],
        $code
      );

      if ($result['success']) {
        $_SESSION['success'] = 'Password reset link has been sent to your email.';
      } else {
        $_SESSION['error'] = $result['message'];
      }

      header('Location: forgotten_password.php');
      exit();
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
