<?php
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
include 'session.php';

// Check if user is signed in
if (!isset($user['id'])) {
  $_SESSION['error'] = 'Signin First !!!';
  header("Location: Signin");
  exit();
}

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
curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => [
    "Authorization: Bearer " . $_ENV['PAYSTACK_SECRET_KEY'],
    "Cache-Control: no-cache",
  ],
]);

$response = curl_exec($curl);
if (curl_errno($curl)) {
  $error = curl_error($curl);
  echo "cURL Error: $error";
  exit;
}
curl_close($curl);

// Decode JSON response from Paystack API
$result = json_decode($response, true);

// If payment was successful, retrieve information from response and insert into database
if ($result['data']['status'] == 'success') {
  $status = $result['data']['status'];
  $reference = $result['data']['reference'];
  $amount = $result['data']['amount'] / 100;
  $book_id = $result['data']['metadata']['book_id'];

  $sql = "SELECT * FROM producttb WHERE id = ?";
  $stmts = $conn->prepare($sql);
  $stmts->execute([$book_id]);
  $result_b = $stmts->fetch(PDO::FETCH_ASSOC);

  $book = $result_b['product_name'];
  $lname = $result['data']['customer']['last_name'];
  $fname = $result['data']['customer']['first_name'];
  $fullname = $fname . ' ' . $lname;
  $Cus_email = $result['data']['customer']['email'];
  $Date_time = date('Y-m-d');
  $qty = 1;
  $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $code = substr(str_shuffle($set), 0, 7);

  $stmt = $conn->prepare("INSERT INTO payments (customerid, status, amount, reference, fullname, date, email, book, quantity, code) VALUES(:customerid, :status, :amount, :reference, :fullname, :date, :email, :book, :quantity, :code)");
  $stmt->execute([
    ':customerid' => $user_id,
    ':status' => $status,
    ':amount' => $amount,
    ':reference' => $reference,
    ':fullname' => $fullname,
    ':date' => $Date_time,
    ':email' => $Cus_email,
    ':book' => $book,
    ':quantity' => $qty,
    ':code' => $code
  ]);

  $redirect = 'download_link.app.pro.php?id=' . $book_id . '&code=' . $code;
  header('Location: ' . $redirect);
  exit();
  } else {
  $_SESSION['error'] = "Payment verification failed: " . $result['data']['gateway_response'];
  header("location:description_pro.php?id=" . $id);
}
