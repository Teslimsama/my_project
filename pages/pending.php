<?php include 'app/reset_app.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../Images/apple-touch-icon.png">
  <link rel="shortcut icon" type="image/png" href="../Images/android-chrome-512x512.png">
  <title>
    Reset Password || Unibooks
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/e9de02addb.js" crossorigin="anonymous"></script> 
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" >
  <link id="pagestyle" href="../assets/css/profile.css" rel="stylesheet" >
</head>
<body>
    <div class="card what w-70 text-center"  >
        
        <form class="login-form" action="Signin" method="post" style="text-align: center;">
            <p class="mt-3">
                We sent an email to  <b><?php echo $_GET['email'] ?></b> to help you recover your account. 
            </p>
            <p>Please login into your email account and click on the link we sent to reset your password</p>
        </form>

    </div>
    <style>
    .card{
    justify-content: center;
    margin-top: 250px;
    margin-left: 230px;
    }
    </style>
		
</body>
</html>