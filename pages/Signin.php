<?php
include('config/alert.message.php');
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In || Unibooks</title>
    <link rel="apple-touch-icon" sizes="76x76" href="../Images/apple-touch-icon.png">
  <link rel="shortcut icon" type="image/png" href="../Images/android-chrome-512x512.png">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/signin.css">
    <link rel="stylesheet" href="../assets/css/material-dashboard.css">
    
</head>
<body>
  <div class="container z-index-sticky top-0 mb-5  ">
    <div class="row">
      <div class=" ">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur border-radius-xl top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4 ">
          <div class="container-fluid ps-2 pe-0">
            <a href="../Images/unibooks copy.png"> <img class="me-3 " src="../Images/unibooks copy.png" alt="" width="50"></a>
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="./about_us.php" target="_blank">
             <h4> Unibooks</h4>
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2 " >
                <span class="navbar-toggler-bar bar1 "></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                  <a class="nav-link title d-flex align-items-center me-2 active" aria-current="page" href="./content.php">
                    <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                    Dashboard
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2 title" href="./profilepage.php">
                    <i class="fa fa-user opacity-6 text-dark me-1"></i>
                    Profile
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2 title" href="./Signup.php">
                    <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                    Sign Up
                  </a>
                </li>
               
              </ul>

            </div>
          </div>
        </nav>
        <!-- End Navbar -->

      <main class="container-fluid text-center mt-5 col-lg-12">
         
    
    
        <div class="form-signin bg-light rounded">
            
          
       <form action="app/signin.app.php" method="POST">
        <a href="../Images/unibooks copy.png"> <img class="me-3 " src="../Images/unibooks copy.png" alt="" width="200" height="150"></a>
         <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
     
         <div class="form-floating">
           <input type="email" class="form-control  <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php if(isset($_COOKIE["email"])) { echo $_COOKIE["email"]; } ?> id="floatingInput" name="email" placeholder="Email">
           <span class="invalid-feedback"><?php echo $username_err; ?></span>

           <label for="floatingInput">Email address</label>
         </div>
         <div class="form-floating pass mt-3">
           <input type="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" id="floatingPassword" name="password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" placeholder="Password">
           <span class="invalid-feedback"><?php echo $password_err; ?></span>
           <!-- <span onclick="togglePass()"><i class="fa fa-eye-slash"></i></span> -->
           <label for="floatingPassword">Password</label>
         </div>
     
         <div class="checkbox mb-3">
          <div class="form-check form-switch d-flex align-items-center mb-3">
            <input class="form-check-input" type="checkbox" id="rememberMe" checked>
            <label class="form-check-label mb-0 ms-3" name="remember">Remember me</label>
          </div>
         </div>
         <button class="w-100 btn btn-lg btn-primary" name="login" type="submit">Sign in</button>
         <p class="mt-4 text-sm text-center">
          Don't have an account?
          <a href="./Signup.php" class="text-primary text-gradient font-weight-bold">Sign up</a>
         
          <p class="text-center text-light mt-3">&copy; 
          <script>
          document.write(new Date().getFullYear())
        </script> Testech, Ltd</p>
       </form>
      </div>  
      <!-- footer  -->
      <div class="container-fluid bg- mt-5 ">
          <footer class="py-3 my-4 ">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3 ">
              <li class="nav-item"><a href="#" class="nav-link px-2 text-light">Home</a></li>
              <li class="nav-item"><a href="#" class="nav-link px-2 text-light">Features</a></li>
              <li class="nav-item"><a href="#" class="nav-link px-2 text-light">Pricing</a></li>
              <li class="nav-item"><a href="#" class="nav-link px-2 text-light">FAQs</a></li>
              <li class="nav-item"><a href="#" class="nav-link px-2 text-light">About</a></li>
            </ul>
            <p class="text-center text-light">&copy; 
              <script>
              document.write(new Date().getFullYear())
            </script> Testech, Ltd</p>
            
          </footer>
            </div>
      <!-- footer  -->
      </main>
     
      
    <script src="https://kit.fontawesome.com/3252b22438.js" crossorigin="anonymous"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/material-dashboard.js"></script>
</body>
</html>