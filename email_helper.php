<?php

/**
 * Email Helper Functions
 * Centralized email sending functionality using PHPMailer
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/PHPMailer/src/Exception.php';
require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/src/SMTP.php';

/**
 * Send an email using configured SMTP settings
 * 
 * @param string $to Recipient email address
 * @param string $subject Email subject
 * @param string $body Email body (HTML)
 * @param string $recipientName Recipient name (optional)
 * @return array ['success' => bool, 'message' => string]
 */
function sendEmail($to, $subject, $body, $recipientName = '')
{
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = $_ENV['MAIL_HOST'] ?? 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV['MAIL_USERNAME'] ?? '';
        $mail->Password   = $_ENV['MAIL_PASSWORD'] ?? '';

        // Encryption
        $encryption = $_ENV['MAIL_ENCRYPTION'] ?? 'tls';
        if ($encryption === 'ssl') {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = $_ENV['MAIL_PORT'] ?? 465;
        } else {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $_ENV['MAIL_PORT'] ?? 587;
        }

        // Recipients
        $fromAddress = $_ENV['MAIL_FROM_ADDRESS'] ?? 'noreply@unibooks.com.ng';
        $fromName = $_ENV['MAIL_FROM_NAME'] ?? 'Unibooks';

        $mail->setFrom($fromAddress, $fromName);
        $mail->addAddress($to, $recipientName);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = strip_tags($body); // Plain text version

        // Send
        $mail->send();

        return [
            'success' => true,
            'message' => 'Email sent successfully'
        ];
    } catch (Exception $e) {
        return [
            'success' => false,
            'message' => "Email could not be sent. Error: {$mail->ErrorInfo}"
        ];
    }
}

/**
 * Send password reset email
 * 
 * @param string $email Recipient email
 * @param string $firstName Recipient first name
 * @param string $lastName Recipient last name
 * @param string $resetCode Reset code
 * @return array ['success' => bool, 'message' => string]
 */
function sendPasswordResetEmail($email, $firstName, $lastName, $resetCode)
{
    $subject = 'Password Reset Link - Unibooks';

    $body = "
    <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
        <h2 style='color: #6366f1;'>Password Reset Request</h2>
        <p>Dear {$firstName} {$lastName},</p>
        <p>We received a request to reset your password. Click the button below to reset your password:</p>
        <div style='text-align: center; margin: 30px 0;'>
            <a href='http://localhost/my_project/password_reset.php?email={$email}&code={$resetCode}' 
               style='background-color: #6366f1; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block;'>
                Reset Password
            </a>
        </div>
        <p>If you didn't request this, you can safely ignore this email.</p>
        <p>This link will expire in 24 hours.</p>
        <hr style='margin: 30px 0; border: none; border-top: 1px solid #e5e7eb;'>
        <p style='color: #6b7280; font-size: 14px;'>
            Thank you,<br>
            The Unibooks Team
        </p>
    </div>
    ";

    return sendEmail($email, $subject, $body, "{$firstName} {$lastName}");
}

/**
 * Send account activation email
 * 
 * @param string $email Recipient email
 * @param string $firstName Recipient first name
 * @param string $activationCode Activation code
 * @return array ['success' => bool, 'message' => string]
 */
function sendActivationEmail($email, $firstName, $activationCode)
{
    $subject = 'Activate Your Unibooks Account';

    $body = "
    <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
        <h2 style='color: #6366f1;'>Welcome to Unibooks!</h2>
        <p>Dear {$firstName},</p>
        <p>Thank you for registering with Unibooks. Please activate your account by clicking the button below:</p>
        <div style='text-align: center; margin: 30px 0;'>
            <a href='http://localhost/my_project/activate.php?email={$email}&code={$activationCode}' 
               style='background-color: #6366f1; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block;'>
                Activate Account
            </a>
        </div>
        <p>If you didn't create this account, you can safely ignore this email.</p>
        <hr style='margin: 30px 0; border: none; border-top: 1px solid #e5e7eb;'>
        <p style='color: #6b7280; font-size: 14px;'>
            Thank you,<br>
            The Unibooks Team
        </p>
    </div>
    ";

    return sendEmail($email, $subject, $body, $firstName);
}

/**
 * Check if email is configured
 * 
 * @return bool
 */
function isEmailConfigured()
{
    return !empty($_ENV['MAIL_USERNAME']) &&
        !empty($_ENV['MAIL_PASSWORD']) &&
        $_ENV['MAIL_USERNAME'] !== 'your-email@gmail.com';
}
