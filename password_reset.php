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
  <?php include "meta.php" ?>
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
        <h2 class="fw-bold text-dark">Create New Password</h2>
        <p class="text-muted">Enter your new password below</p>
      </div>

      <!-- Display error and success messages -->
      <div class="mb-3">
        <?php
        echo ErrorMessage();
        echo SuccessMessage();
        ?>
      </div>

      <form action="password_new.php?code=<?php echo htmlspecialchars($_GET['code']); ?>&email=<?php echo htmlspecialchars($_GET['email']); ?>" method="post">
        <div class="mb-4">
          <label class="form-label text-sm fw-bold">New Password</label>
          <input type="password" class="form-control" name="password" placeholder="••••••••" required>
        </div>
        <div class="mb-4">
          <label class="form-label text-sm fw-bold">Confirm New Password</label>
          <input type="password" class="form-control" name="repassword" placeholder="••••••••" required>
        </div>

        <div class="d-grid gap-2">
          <button type="submit" value="Next" name="reset" class="btn btn-primary py-3 rounded-pill shadow-primary fw-bold">Reset Password</button>
          <a href="Signin" class="btn btn-light py-3 rounded-pill fw-bold">Cancel</a>
        </div>
      </form>
    </div>

    <?php include "footer.php" ?>
  </main>

  <?php include "bottom_nav_app.php"; ?>
  <?php include "plugin.php" ?>

  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
</body>

</html>