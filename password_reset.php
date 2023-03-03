<?php include 'session.php'; ?>
<?php
if (!isset($_GET['code']) or !isset($_GET['email'])) {
  header('location: forgotten_password');
  exit();
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

  <div class="container code vw-80 mt-5 col-lg-12 form-control ">
    <div class="card mt-5 bg-light ">
      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
          <h4 class="text-white text-center text-capitalize ps-3">Reset Password</h4>

        </div>
        <div style="margin: top 600px;" class="card-body">
          <form class="login-form" action="password_new.php?code=<?php echo $_GET['code']; ?>&email=<?php echo $_GET['email']; ?>" method="post">
            <div class="form-floating m-3">
              <input style="border: solid grey 1px;" type="password" class="form-control ps-2" id="floatingInput" name="password" placeholder="123456">
              <label for="floatingInput">Password</label>
            </div>
            <div class="form-floating m-3">
              <input style="border: solid grey 1px;" type="password" class="form-control ps-2" id="floatingInput" name="repassword" placeholder="123456">
              <label for="floatingInput">Confirm Password</label>
            </div>

            <div class="form-group text-center row m-3">
              <div class="col-6">
                <a href="forgotten_password.php" class="btn btn-sm btn-dark ">
                  Cancel
                </a>
              </div>
              <div class="col-6">
                <input type="submit" value="Next" name="reset"  class="btn btn-sm btn-dark ">
              </div>
              <div class="col-6  ">
                <a class="btn btn-dark btn-sm "  href="Signin.php">Login</a>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>



    <?php include "footer.php" ?>

</body>

</html>