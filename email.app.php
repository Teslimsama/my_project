<?php

/**
 * Password Reset Email Sender
 * This file sends password reset emails using the centralized email helper
 * 
 * Required variables before including this file:
 * - $email: Recipient email address
 * - $row: Array containing user data (firstname, lastname, id)
 * - $code: Password reset code
 */

// Include session and email helper
require_once __DIR__ . '/session.php';
require_once __DIR__ . '/email_helper.php';

// Validate required variables
if (!isset($email) || !isset($row) || !isset($code)) {
  $_SESSION['error'] = 'Missing required data for sending email';
  exit();
}

// Check if email is configured
if (!isEmailConfigured()) {
  $_SESSION['error'] = 'Email service is not configured. Please contact the administrator.';
  exit();
}

// Send password reset email using helper function
$result = sendPasswordResetEmail(
  $email,
  $row['firstname'] ?? '',
  $row['lastname'] ?? '',
  $code
);

if ($result['success']) {
  $_SESSION['success'] = 'Password reset link has been sent to your email.';
} else {
  $_SESSION['error'] = $result['message'];
}
