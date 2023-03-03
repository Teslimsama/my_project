<?php
include 'session.php';
include 'alert.message.php';
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
  </style>

  <div class="container mt-5  ">
    <div class="card mt-5  ">
      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
          <h4 class="text-white text-center text-capitalize ps-3">Reset Password</h4>
        </div>
       
        <div class="card-body">
          <form class=" form-control" action="reset_app.php" method="post">
             <?php echo ErrorMessage();
        echo SuccessMessage(); ?>
            <div class="form-floating">
              <input type="email" style="border: solid grey 1px;" class="form-control" id="floatingInput" name="email" placeholder="Email">
              <label for="floatingInput">Email address</label>
            </div>

            <div class="form-group text-center  m-3">
              <input type="submit" name="reset" class="w-80 btn btn-dark">
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
  <?php include "footer.php" ?>

</body>

</html>