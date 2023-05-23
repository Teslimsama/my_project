<?php
include "session.php";

$user_id = $user['id'];

$ref = $_GET['status'];
if ($ref == "") {
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}



if ($_GET['status'] === 'completed') {
  $id = $_GET['id'];
  $sql = "SELECT * FROM producttb WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$id]);
  $result = $stmt->fetch();
  print_r($result);
  $reference = $_GET['tx_ref'];
  $status = 'success';
  $amount = $result['product_price'];

  $book = $result['product_name'];
  $lname = $user['lastname'];
  $fname = $user['firstname'];
  $fullname = $fname . ' ' . $lname;
  $Cus_email = $user['email'];
  $Date_time = date('Y-m-d');
  $qty = 1;
  $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $code = substr(str_shuffle($set), 0, 7);

  $stmt = $conn->prepare("INSERT INTO payments (customerid, status, reference, fullname, date, email,quantity,code,book,amount) VALUES(:customerid, :status,  :reference, :fullname, :date, :email,:quantity,:code ,:book,:amount)");
  $stmt->execute(array(
    ':customerid' => $user_id,
    ':status' => $status,
    ':reference' => $reference,
    ':fullname' => $fullname,
    ':date' => $Date_time,
    ':email' => $Cus_email,
    ':code' => $code,
    ':quantity' => $qty,
    ':book' => $book,
    ':amount' => $amount,
  ));

  $redirect = "download_link.app.pro.php?id=" . $id . "&code=" . $code;
  header("location:" . $redirect);
}
