<?php
include('session.php');
include 'alert.message.php'

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link rel="apple-touch-icon" sizes="76x76" href="Images/apple-touch-icon.png">
  <link rel="shortcut icon" type="image/png" href="Images/android-chrome-512x512.png">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/signup.css">
  <link rel="stylesheet" href="assets/css/material-dashboard.css">
  <script src="https://kit.fontawesome.com/e9de02addb.js" crossorigin="anonymous"></script>
</head>

<body>

  <div class="container z-index-sticky top-0 mb-5  ">
    <div class="row">
      <div class="col-12  ">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur border-radius-xl top-0 z-index-3 bg-dark shadow position-absolute my-3 py-2 start-0 end-0 mx-4 ">
          <div class="container-fluid ps-2 pe-0">
            <a href="Images/unibooks copy.png"> <img class="me-3 " src="Images/unibooks copy.png" alt="" width="50"></a>
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="./about_us.php" target="_blank">
              <h4> Unibooks</h4>
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2 ">
                <span class="navbar-toggler-bar bar1 "></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                  <a class="nav-link title d-flex align-items-center me-2 active" aria-current="page" href="./about_us">
                    <i class="fa-solid fa-hashtag opacity-6 text-dark me-1 "></i>
                    About Us
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2 title" href="./about_us">
                    <i class="fa-solid fa-table-layout opacity-6 text-dark me-1"></i>
                    Social Media
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2 title" href="./Signin">
                    <i class="fa-solid fa-arrow-right-to-bracket opacity-6 text-dark me-1"></i>
                    Login
                  </a>
                </li>

              </ul>

            </div>
          </div>
      </div>
    </div>
  </div>
  </nav>
  <!-- End Navbar -->
  </header>

  <div class="container form-control ">
    <div class="card mt-5 bg-light ">
      <div class="card-body">
        <div class="text-center">
          <h3>Create a Unibooks Account </h3>
        </div>
        <?php echo ErrorMessage();
        echo SuccessMessage(); ?>

        <form action="signup.app.php " method="POST">
          <div class="row">

            <div class="first col-6">
              <label for="">Firstname</label>
              <input style="border: 2px solid grey ;" type="text" class="form-control" name="firstname" placeholder="first name">
            </div>
            <div class="last col-6">
              <label for="">Lastname</label>
              <input style="border: 2px solid grey ;" type="text" class="form-control" name="lastname" placeholder="last name">
            </div>
          </div>

          <div class="user">
            <label>Username</label>
            <input style="border: 2px solid grey ;" type="text" name="username" placeholder="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?> ">
            <span class="invalid-feedback"><?php echo $username_err; ?></span>
          </div>

          <div class="email">
            <label for="">Email</label>
            <input style="border: 2px solid grey ;" type="email" class="form-control" name="email" placeholder="Enter Valid email" required>
          </div>

          <div class="row">
            <div class="phone col-6">
              <label for="">Phone No</label>
              <input style="border: 2px solid grey ;" type="tel" class="form-control" name="phone" placeholder="phone eg.080874456644" required>

            </div>
            <div class="level col-6">
              <label for="">Level</label>
              <select class="form-select form-select-md" name="levell" aria-label=".form-select-mg example">
                <option> Current Level</option>
                <option value="100">100L</option>
                <option value="200">200L</option>
                <option value="300">300L</option>
                <option value="400">400L</option>
                <option value="500">500L</option>
              </select>


            </div>
          </div>

          <div class="School mt-3">
            <select class="form-select form-select-md" name="school" aria-label=".form-select-mg example">
              <option> Select Your School of Study</option>
              <option value="Ahmedu Bello University">Ahmedu Bello University</option>
              <option value="FUTMINNA">FUTMINNA</option>
              <option value="FUTA">FUTA</option>
            </select>
          </div>
          <div class="gender mt-4">Gender
            <div class="form-check">
              <input class="form-check-input" type="radio" name="gender" value="male" id="gender">
              <label class="form-check-label" for="flexRadioDefault1">
                Male
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="gender" value="female" id="gender" checked>
              <label class="form-check-label" for="flexRadioDefault2">
                Female
              </label>
            </div>
          </div>

          <div class="password">
            <label class="mt-3" for="">Create Password</label>
            <input style="border: 2px solid grey ;" type="password" class="form-control" name="password" placeholder="create a password" required>
          </div>
          <div class="confirm">
            <label for="">Confirm Your Password</label>
            <input style="border: 2px solid grey ;" type="password" class="form-control " name="repassword" placeholder="confirm password" required>


          </div>
          <div class="row">

            <div class="mt-4 col-6">
              <label for="">Date of birth</label>
              <input style="border: 2px solid grey ;" type="date" class="form-control" name="dob" placeholder="" required>
            </div>
            <div class="referral col-6">
              <label for=""></label>
              <input style="border: 2px solid grey ;" type="text" class="form-control" name="refer" placeholder="How did you hear about us?" required>
            </div>
          </div>
          <div class="mt-5">
            <button class="btn btn-dark w-100" name="submit" type="submit"> Sign Up
            </button>
          </div>
          <small class="text-center">By contiuning you confirm that you agree to the terms of use and confirm that you have read the <a href="#">privacy policy</a> </small>
      </div>
      </form>
    </div>
  </div>
  </div>


  </div>
  <!-- footer  -->
  <?php include "footer.php" ?>

  <!-- footer  -->
  <script src="https://kit.fontawesome.com/3252b22438.js" crossorigin="anonymous"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>