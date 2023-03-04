<?php
include 'session.php';
include 'alert.message.php';
// expire code
// function is_code_correct($code)
// {
//   global $db_connect;

//   $code = addslashes($code);
//   $expire = time();
//   $email = addslashes($_SESSION['forgotten_password']['email']);

//   $query = "select * from code where code = '$code' && email = '$email' order by id desc limit 1";
//   $result = mysqli_query($db_connect, $query);
//   if ($result) {
//     if (mysqli_num_rows($result) > 0) {
//       $row = mysqli_fetch_assoc($result);
//       if ($row['expire'] > $expire) {

//         return "This Code was Valid";
//       } else {
//         return "This Code has Expired";
//       }
//     } else {
//       return "This Code isn't Valid";
//     }
//   }

//   return "This Code isn't Valid";
// }

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
  <link href="assets/css/content.css" rel="stylesheet" />
  <link href="assets/css/signin.css" rel="stylesheet" />
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
 
  <div class="container mt-5  ">
    <div class="card mt-5 form-signin  ">
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