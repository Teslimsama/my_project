<?php

/**
 * EMAIL TEST FILE - FOR DEVELOPMENT ONLY
 * 
 * This file is used to test email functionality.
 * It should NOT be used in production.
 * 
 * To test emails, use the centralized email_helper.php instead.
 * 
 * Example usage:
 * 
 * require_once 'email_helper.php';
 * 
 * $result = sendEmail(
 *     'test@example.com',
 *     'Test Subject',
 *     '<h1>Test Email</h1><p>This is a test email.</p>',
 *     'Test User'
 * );
 * 
 * if ($result['success']) {
 *     echo 'Email sent successfully!';
 * } else {
 *     echo 'Error: ' . $result['message'];
 * }
 */

require_once __DIR__ . '/email_helper.php';

// Check if email is configured
if (!isEmailConfigured()) {
    die('Email is not configured. Please update your .env file with SMTP credentials.');
}

// Test email sending
$result = sendEmail(
    'bolajiteslim07@gmail.com', // Change this to your test email
    'Test Email from Unibooks',
    '<h2>Email Test</h2><p>This is a test email from the Unibooks application.</p><p>If you received this, your email configuration is working correctly!</p>',
    'Test User'
);

if ($result['success']) {
    echo '<h1 style="color: green;">✓ Email sent successfully!</h1>';
    echo '<p>Check your inbox at bolajiteslim07@gmail.com</p>';
} else {
    echo '<h1 style="color: red;">✗ Email failed to send</h1>';
    echo '<p>Error: ' . htmlspecialchars($result['message']) . '</p>';
    echo '<p>Please check your .env file configuration.</p>';
}
