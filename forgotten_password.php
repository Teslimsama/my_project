<?php
include 'session.php';


$error = array();

$mode = "enter_email";
if (isset($_GET['mode'])) {
  $mode = $_GET['mode'];
}

//something is posted
if (count($_POST) > 0) {

  switch ($mode) {
    case 'enter_email':
      // code...
      $email = $_POST['email'];
      //validate email
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = "Please enter a valid email";
      } elseif (!valid_email($email)) {
        $error[] = "That email was not found";
      } else {

        $_SESSION['forgotten_password']['email'] = $email;
        send_email($email);
        header("Location: forgotten_password.php?mode=enter_code");
        die;
      }
      break;

    case 'enter_code':
      // code...
      $code = $_POST['code'];
      $result = is_code_correct($code);

      if ($result == "This Code was Valid") {

        $_SESSION['forgotten_password']['code'] = $code;
        header("Location: forgotten_password.php?mode=enter_password");
        die;
      } else {
        $error[] = $result;
      }
      break;

    case 'enter_password':
      // code...
      $password = $_POST['password'];
      $password2 = $_POST['password2'];

      if ($password !== $password2) {
        $error[] = "Passwords do not match";
      } elseif (!isset($_SESSION['forgotten_password']['email']) || !isset($_SESSION['forgotten_password']['code'])) {
        header("Location: forgotten_password.php");
        die;
      } else {

        save_password($password);
        if (isset($_SESSION['forgotten_password'])) {
          unset($_SESSION['forgotten_password']);
        }

        header("Location: Signin.php");
        die;
      }
      break;

    default:
      // code...
      break;
  }
}

function send_email($email)
{

  global $db_connect;

  $expire = time() + (60 * 5);
  $code = rand(100000, 999999);
  $email = addslashes($email);

  $query = "insert into code (email,code,expire) value ('$email','$code','$expire')";
  mysqli_query($db_connect, $query);
  $subject = 'password reset';
  $message = 'Password reset,Your code is ' . $code;
  $header = 'From: info@unibooks.com.ng';
  //send email here 
  // if(send)
  mail($email, $subject, $message, $header);
}

function save_password($password)
{

  global $db_connect;

  $password = password_hash($password, PASSWORD_DEFAULT);
  $email = addslashes($_SESSION['forgotten_password']['email']);

  $query = "update unibooker set password = '$password' where email = '$email' limit 1";
  mysqli_query($db_connect, $query);
}

function valid_email($email)
{
  global $db_connect;

  $email = addslashes($email);

  $query = "select * from unibooker where email = '$email' limit 1";
  $result = mysqli_query($db_connect, $query);
  if ($result) {
    if (mysqli_num_rows($result) > 0) {
      return true;
    }
  }

  return false;
}

function is_code_correct($code)
{
  global $db_connect;

  $code = addslashes($code);
  $expire = time();
  $email = addslashes($_SESSION['forgotten_password']['email']);

  $query = "select * from code where code = '$code' && email = '$email' order by id desc limit 1";
  $result = mysqli_query($db_connect, $query);
  if ($result) {
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      if ($row['expire'] > $expire) {

        return "This Code was Valid";
      } else {
        return "This Code has Expired";
      }
    } else {
      return "This Code isn't Valid";
    }
  }

  return "This Code isn't Valid";
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="Images/apple-touch-icon.png">
  <link rel="shortcut icon" type="image/png" href="Images/android-chrome-512x512.png">
  <title>
    Reset Password || Unibooks
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/e9de02addb.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet">
  <!-- <link id="pagestyle" href="assets/css/profile.css" rel="stylesheet" > -->
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9952650109664010" crossorigin="anonymous"></script>
</head>

<body>
  <style>
    body {
      background-image: url(Images/mob7.jpg);

      background-size: cover;
      background-repeat: no-repeat;
      height: 100vh;
    }

    .msg {
      margin: 5px auto;
      border-radius: 5px;
      border: 1px solid red;
      background: pink;
      text-align: left;
      color: brown;
      padding: 10px;
    }

    /* 
    @media screen and (max-width:400px) {
      .code {
        width: 355px;
      }

      .codeRow {
        --bs-gutter-x: 1.5rem;
        --bs-gutter-y: 0;
        display: grid;
        grid-template-columns: 40% 40% auto;

      }

      .pass {
        margin-bottom: 100vh;
      }

      .het {
        margin-bottom: 100vh;
      }

      body {
        background-image: url(Images/pexels-pixabay-207691.jpg);

        background-size: cover;
        background-repeat: no-repeat;
        height: 100%;
      }

    }

    @media screen and (max-width:800px) {

      .pass {
        margin-bottom: 100vh;
      }

      .het {
        margin-bottom: 100vh;
      }

    }

    .codeRow {
      --bs-gutter-x: 1.5rem;
      --bs-gutter-y: 0;
      display: grid;
      grid-template-columns: 40% 40% auto;

    } */
  </style>
  <?php

  switch ($mode) {
    case 'enter_email':
      // code...
  ?>
      <div class="container mt-5 vw-80  het form-control ">
        <div class="card mt-5 bg-light ">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
              <h4 class="text-white text-center text-capitalize ps-3">Reset Password</h4>

            </div>
            <div style="margin: top 600px;" class="card-body">
              <form class="login-form" action="forgotten_password.php?mode=enter_email" method="post">



                <?php if (count($error) > 0) : ?>
                  <div class="msg">
                    <?php foreach ($error as $error) : ?>
                      <span><?php echo $error ?></span>
                    <?php endforeach ?>
                  </div>
                <?php endif ?>


                <div class="form-floating m-3">
                  <input type="email" style="border: solid grey 1px;" class="form-control" id="floatingInput" name="email" placeholder="Email">
                  <label for="floatingInput">Email address</label>
                </div>

                <div class="form-group text-center  m-3">
                  <input type="submit" name="Next" class="w-80 btn btn-dark">
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
    <?php
      break;

    case 'enter_code':
      // code...
    ?>
      <div class="container code vw-80 mt-5 col-lg-12 form-control ">
        <div class="card mt-5 bg-light ">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
              <h4 class="text-white text-center text-capitalize ps-3">Reset Password</h4>

            </div>
            <div style="margin: top 600px;" class="card-body">
              <form class="login-form" action="forgotten_password.php?mode=enter_code" method="post">



                <?php if (count($error) > 0) : ?>
                  <div class="msg">
                    <?php foreach ($error as $error) : ?>
                      <span><?php echo $error ?></span>
                    <?php endforeach ?>
                  </div>
                <?php endif ?>


                <div class="form-floating m-3">
                  <input style="border: solid grey 1px;" type="text" class="form-control ps-2" id="floatingInput" name="code" placeholder="123456">
                  <label for="floatingInput">Enter your OTP</label>
                </div>

                <div class="form-group text-center row m-3">
                  <div class="col-6">
                    <a href="forgotten_password.php">
                      <input type="button" style="float: left;" class="btn btn-dark btn-sm" value="Cancel">
                    </a>
                  </div>
                  <div class="col-6">
                    <input type="submit" value="Next" style="float: right;" class="btn btn-sm btn-dark ">
                  </div>
                  <div class="col-6 mt-2 mb-0 ">
                    <a class="btn btn-dark btn-sm " style="float: left;" href="Signin.php">Login</a>
                  </div>
                </div>
              </form>

            </div>
          </div>
        </div>
      <?php
      break;

    case 'enter_password':
      // code...
      ?>
        <div class="container mt-5 col-lg-12 pass form-control ">
          <div class="card mt-5 bg-light ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h4 class="text-white text-center text-capitalize ps-3">Reset Password</h4>

              </div>
              <div style="margin: top 600px;" class="card-body">
                <form class="login-form" action="forgotten_password.php?mode=enter_password" method="post">



                  <?php if (count($error) > 0) : ?>
                    <div class="msg">
                      <?php foreach ($error as $error) : ?>
                        <span><?php echo $error ?></span>
                      <?php endforeach ?>
                    </div>
                  <?php endif ?>


                  <div class="form-group text-center  m-3">
                    <div class="form-floating m-3">
                      <input type="text" style="border: solid grey 1px;" class="form-control" id="floatingInput" name="password" placeholder="Password">
                      <label for="floatingInput">Password</label>
                    </div>
                    <div class="form-floating m-3">
                      <input type="text" style="border: solid grey 1px;" class="form-control" id="floatingInput" name="password2" placeholder="Password">
                      <label for="floatingInput">Confrim Password</label>
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <a href="forgotten_password.php">
                          <input type="button" value="Cancel" class="btn btn-dark ">
                        </a>
                      </div>
                      <div class="col-6">
                        <input type="submit" value="Next" class="btn btn-dark ">
                      </div>
                      <div class="col-12">
                        <a class="btn btn-dark"style="float:left;" href="Signin.php">Login</a>
                      </div>
                    </div>
                  </div>


                  <!-- <br><br> -->
                </form>
              </div>

            </div>
          </div>
        </div>
    <?php
      break;

    default:
      // code...
      break;
  }

    ?>
    <?php include "footer.php" ?>

</body>

</html>