<?php
include_once 'config/database.php';

    $ref = $_GET['status'] !== "success";
    if ($ref = "") {
        header("location:javascript://history.go(-1)";
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
    $lname = $result->data->customer->last_name;
    $fname = $result->data->customer->first_name;
    $fullname = $fname.' '.$lname;
    $Cus_email = $result->data->customer->email;
    date_default_timezone_set('Africa/lagos');
    $Date_time = date('m/d/Y h:i:s a',time());

    $stmt = $db_connect->prepare("INSERT INTO payments (status,reference,fullname,date,email) VALUES (?,?,?,?,?)");
    $stmt->bind_param("sssss", $status,$reference,$fullname,$Date_time,$Cus_email);
    $stmt->execute();
    if (!$stmt) {
        echo 'there was a problem on your code'. mysqli_error($db_connect);
    }else  {
    header("location:success?status=success");
      exit;  
    }
    $stmt->close();
    $db_connect->close();

  }else {
    header("location:error");
  }
?>
