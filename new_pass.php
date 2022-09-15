<?php include_once 'app/reset_app.php'; ?>

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
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" >
  <link id="pagestyle" href="assets/css/profile.css" rel="stylesheet" >
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9952650109664010"
     crossorigin="anonymous"></script>
</head>
<body>
            <div class="container mt-5 col-lg-12 w-50 form-control ">
                <div class="card mt-5 bg-light ">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h4 class="text-white text-center text-capitalize ps-3">New Password</h4>
              
              </div>
            <div class="card-body">
            <form class="login-form" action="new_pass" method="post">

            <?php include('message.php'); ?>
            <div class="form-floating m-3">
                        <input type="password" class="form-control" id="floatingInput" name="new_pass" placeholder="Email">
                        <label for="floatingInput">New Password</label>
                      </div>
                      <div class="form-floating m-3">
                        <input type="password" class="form-control" id="floatingInput" name="new_pass_c" placeholder="Email">
                        <label for="floatingInput">Confirm New Password</label>
                      </div>
            <div class="form-group">
                <button type="submit" name="new_password" class="btn btn-dark text-center mt-3">Submit</button>
            </div>
        </form>
            </div>
                    
                    </div>
                    </div>
            </div>
</body>
</html>

           