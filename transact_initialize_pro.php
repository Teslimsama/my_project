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
// Check if a product ID is provided in the URL
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $stmt = $conn->prepare("SELECT * FROM producttb WHERE id = :id");
  $stmt->execute(['id' => $_GET['id']]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$row) {
    $_SESSION['error'] = "No file found.";
    header("location:description_pro.php?id=" . $id);
    exit();
  }
} else {
  $_SESSION['error'] = "No file specified.";
  header("location:description_pro.php?id=" . $id);
  exit();
}

// Initialize Paystack transaction
$email = $user['email'];
$book_id = $_GET['id'];
$first_name = $user['firstname'] ;
$last_name=$user['lastname'];
$phone = $user['phone'];
$amount = $row['product_price'] * 100; // Convert to kobo
$callback_url = "http://localhost/Online/fm-selection-2025585_07-30-15\public_html/transact_verify_pro.php"; // Replace with your callback URL
// $callback_url = "https://unibooks.com.ng/transact_verify_pro.php"; // Replace with your callback URL

$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'amount' => $amount,
    'last_name' => $last_name,
    'first_name' => $first_name,
    'book_id' => $book_id,
    'phone' => $phone,
    'email' => $email,
    'callback_url' => $callback_url,
    'metadata' => [
      'book_id' => $book_id,
      'phone' => $phone,
    ]
  ]),
  CURLOPT_HTTPHEADER => [
    "authorization: Bearer " . $_ENV['PAYSTACK_SECRET_KEY'],
    "content-type: application/json",
    "cache-control: no-cache"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

if ($err) {
  die('Curl returned error: ' . $err);
}

$tranx = json_decode($response, true);

if (!$tranx['status']) {
  die('API returned error: ' . $tranx['message']);
}

// Store transaction reference so we can verify in `verify_payment.php`
$_SESSION['transaction_reference'] = $tranx['data']['reference'];

// Redirect to Paystack payment page
header('Location: ' . $tranx['data']['authorization_url']);
exit();
