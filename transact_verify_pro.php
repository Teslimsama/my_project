<?php
include "session.php";

$customerid = $user['id'];

$ref = $_GET['reference'];
if ($ref == "") {
  header("location:javascript://history.go(-1)");
}
?>
<?php
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($ref),
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
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  // echo $response;
  $result = json_decode($response);
}
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
    ':customerid'=> $customerid,
    ':status' => $status,
    ':amount' => $amount, 
    ':reference' => $reference,
    ':fullname' => $fullname,
    ':date' => $Date_time,
    ':email' => $Cus_email,
    ':book' => $book
  ));
  // $stmt = $db_connect->prepare("INSERT INTO payments ( status, reference, fullname, date, email, customerid) VALUES (?,?,?,?,?,?)");
  // $stmt->bind_param("sssssi", $status,$reference,$fullname,$Date_time,$Cus_email,$customerid);
  // $stmt;
  if ($stmt->execute()) {
    // $connect = new PDO("mysql:host=localhost; dbname=unibooks", "root", "");
    $email = $Cus_email;
    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM unibooker WHERE email=:email");
    $stmt->execute(['email' => $email]);
    $row = $stmt->fetch();

    if ($row['numrows'] > 0) {
      //generate code
      $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $code = substr(str_shuffle($set), 0, 15);
      try {
        $stmt = $conn->prepare("UPDATE unibooker SET code=:code WHERE id=$customerid");
        $stmt->execute(['code' => $code, $customerid => $row['id']]);
        $subject ="hi";
        $header ="hi";
        $message = "
          <h2>Password Reset</h2>
          <p>Your Account:</p>
          <p>Email: " . $email . "</p>
          <p>Please click the link below to reset your password.</p>
          <a href='http://localhost/ecommerce/password_reset.php?code=" . $code . "&user=" . $row[' id'] . "'>Reset Password</a>
          ";

        //Load phpmailer
        
        try {
          mail($email, $subject, $message, $header);
         
          
          $_SESSION['success'] = 'Password reset link sent';
        } catch (Exception $e) {
          $_SESSION['error'] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        }
      } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
      }
    } else {
      $_SESSION['error'] = 'Email not found';
      header('location:pass');
      exit;
    }
  } else {
    echo 'there was a problem on your code' . mysqli_error($db_connect);
  }
  // $stmt->close();
  // $db_connect->close();
  header("location:success?status=success");

} else {
  header("location:error");
}
?>

