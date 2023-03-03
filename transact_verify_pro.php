<?php
// Include session.php file
include 'session.php';

// Get user id from user array
$user_id = $user['id'];

// Get reference value from query string and check if it's empty
$reference = $_GET['reference'];
if (empty($reference)) {
  header('Location: ' . $_SERVER['HTTP_REFERER']);
  exit;
}

// Send cURL request to Paystack API to verify payment
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer sk_test_b6e69229a47fa4f88ca61ebe3c855cf9d4014ebb",
    "Cache-Control: no-cache",
  ),
));
$response = curl_exec($curl);
if (curl_errno($curl)) {
  $error = curl_error($curl);
  echo "cURL Error: $error";
  exit;
}
curl_close($curl);

// Decode JSON response from Paystack API
$result = json_decode($response);

// If payment was successful, retrieve information from response and insert into database
if ($result->data->status == 'success') {

  $status = $result->data->status;
  $reference = $result->data->reference;
  $amount = $result->data->amount;

  $book = $result->data->customer->phone;
  $lname = $result->data->customer->last_name;
  $fname = $result->data->customer->first_name;
  $fullname = $fname . ' ' . $lname;
  $Cus_email = $result->data->customer->email;
  date_default_timezone_set('Africa/lagos');
  $Date_time = date('m/d/Y h:i:s a', time());



  $stmt = $conn->prepare("INSERT INTO payments (customerid, status,amount, reference, fullname, date, email,book) VALUES(:customerid, :status, :amount, :reference, :fullname, :date, :email, :book)");
  $stmt->execute(array(
    ':customerid' => $user_id,
    ':status' => $status,
    ':amount' => $amount,
    ':reference' => $reference,
    ':fullname' => $fullname,
    ':date' => $Date_time,
    ':email' => $Cus_email,
    ':book' => $book
  ));

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
