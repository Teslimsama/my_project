<?php
include 'session.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "meta.php"; ?>
  <title>Log In || Unibooks</title>
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
  <link rel="stylesheet" href="assets/css/app.css">
</head>

<body class="bg-light">
  <?php include "header_app.php"; ?>

  <main class="container py-5">
    <div class="auth-card">
      <form action="signin.app.php" method="POST">
        <img class="auth-logo" src="assets/Images/unibooks copy.png" alt="Unibooks Logo">
        <h2 class="h3 mb-4 fw-bold text-center">Welcome Back</h2>

        <?php echo ErrorMessage();
        echo SuccessMessage(); ?>

        <div class="form-floating mb-3">
          <input type="email" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
            value="<?php echo $_COOKIE["email"] ?? ''; ?>"
            id="floatingInput" name="email" placeholder="Email">
          <label for="floatingInput">Email address</label>
          <span class="invalid-feedback"><?php echo $username_err ?? ''; ?></span>
        </div>

        <div class="form-floating mb-3 position-relative">
          <input type="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
            id="floatingPassword" name="password"
            value="<?php echo $_COOKIE["password"] ?? ''; ?>" placeholder="Password">
          <label for="floatingPassword">Password</label>
          <span class="invalid-feedback"><?php echo $password_err ?? ''; ?></span>
          <div class="position-absolute end-0 top-50 translate-middle-y me-3" style="z-index: 10; cursor: pointer;" onclick="togglePass()">
            <i id="eye-icon" class="fa fa-eye text-muted"></i>
          </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="rememberMe" name="remember" checked>
            <label class="form-check-label mb-0 ms-2 text-sm" for="rememberMe">Remember me</label>
          </div>
          <a href="./forgotten_password" class="text-primary text-sm fw-bold text-decoration-none">Forgot?</a>
        </div>

        <button class="w-100 btn btn-lg btn-primary py-3 rounded-pill shadow-primary" name="login" type="submit">Sign in</button>

        <p class="mt-4 text-center text-muted text-sm">
          Don't have an account?
          <a href="./Signup" class="text-primary fw-bold text-decoration-none">Sign up</a>
        </p>
      </form>
    </div>
    <?php include "footer.php"; ?>
  </main>

  <?php include "bottom_nav_app.php"; ?>

  <script>
    function togglePass() {
      const passInput = document.getElementById("floatingPassword");
      const eyeIcon = document.getElementById("eye-icon");
      if (passInput.type === "password") {
        passInput.type = "text";
        eyeIcon.classList.replace("fa-eye", "fa-eye-slash");
      } else {
        passInput.type = "password";
        eyeIcon.classList.replace("fa-eye-slash", "fa-eye");
      }
    }
  </script>
</body>

<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/material-dashboard.js"></script>
</body>

</html>