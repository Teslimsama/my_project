<?php
include "session.php";

$customerid = $user['id'];

$ref = $_GET['status'];
if ($ref == "") {
  header("location:javascript://history.go(-1)");
}
?>
<?php
// $stmt = $conn->prepare("SELECT * FROM project WHERE id=:id");
// $stmt->execute(['id' => $_SESSION['admin']]);
// $admin = $stmt->fetch();
// $status = $_GET['status'];

if ($_GET['status'] === 'successful') {
  $reference = $_GET['tx_ref'];
  $status = 'success';
  // $amount = $;

  // $book = $;
  $lname = $user['lastname'];
  $fname = $user['firstname'];
  $fullname = $fname . ' ' . $lname;
  $Cus_email = $user['email'];
  date_default_timezone_set('Africa/lagos');
  $Date_time = date('m/d/Y h:i:s a', time());



  $stmt = $conn->prepare("INSERT INTO payments (customerid, status, reference, fullname, date, email) VALUES(:customerid, :status,  :reference, :fullname, :date, :email)");
  $stmt->execute(array(
    ':customerid' => $customerid,
    ':status' => $status,
    ':reference' => $reference,
    ':fullname' => $fullname,
    ':date' => $Date_time,
    ':email' => $Cus_email
  ));
//  ,   ':book' => $book, :book,book
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
        $subject = "hi";
        $header = "hi";
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

