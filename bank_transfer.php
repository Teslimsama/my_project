<?php
include "session.php";

$user_id = $user['id'];

$ref = $_GET['status'];
if ($ref == "") {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}



if ($_GET['status'] === 'sent') {
    $reference =
    $tx_ref = 'Unibooks' . rand(99999, 10000000) . 'BTRF';;
    $status = 'pending';
    $lname = $user['lastname'];
    $fname = $user['firstname'];
    $fullname = $fname . ' ' . $lname;
    $Cus_email = $user['email'];
    $Date_time = date('Y-m-d');
    $qty = 1;



    $stmt = $conn->prepare("INSERT INTO payments (customerid, status, reference, fullname, date, email,quantity) VALUES(:customerid, :status,  :reference, :fullname, :date, :email,:quantity)");
    $stmt->execute(array(
        ':customerid' => $user_id,
        ':status' => $status,
        ':reference' => $reference,
        ':fullname' => $fullname,
        ':date' => $Date_time,
        ':email' => $Cus_email,
        ':quantity' => $qty
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
