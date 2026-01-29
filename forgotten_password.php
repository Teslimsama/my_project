<?php
include 'session.php';
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
  <title>Reset Password || Unibooks</title>
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/app.css">
  <script src="https://kit.fontawesome.com/e9de02addb.js" crossorigin="anonymous"></script>
</head>

<body class="bg-light">
  <?php include "header_app.php"; ?>

  <main class="container py-5">
    <div class="auth-card" style="max-width: 500px; margin: 0 auto;">
      <div class="text-center mb-4">
        <h2 class="fw-bold text-dark">Reset Password</h2>
        <p class="text-muted">Enter your email to receive a reset link</p>
      </div>

      <?php echo ErrorMessage();
      echo SuccessMessage(); ?>

      <form action="reset_app.php" method="post">
        <div class="mb-4">
          <label class="form-label text-sm fw-bold">Email Address</label>
          <input type="email" class="form-control" name="email" placeholder="john@university.edu" required>
        </div>

        <div class="d-grid gap-2">
          <button type="submit" name="reset" class="btn btn-primary py-3 rounded-pill shadow-primary fw-bold">Send Reset Link</button>
          <a href="Signin" class="btn btn-light py-3 rounded-pill fw-bold">Back to Login</a>
        </div>
      </form>
    </div>

    <?php include "footer.php" ?>
  </main>

  <?php include "bottom_nav_app.php"; ?>

  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
</body>

</html>