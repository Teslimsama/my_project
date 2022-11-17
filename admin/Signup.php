<?php
include('config/alert.message.php');

?>

<?php include "assets/includes/session.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="apple-touch-icon" sizes="76x76" href="../Images/apple-touch-icon.png">
    <link rel="shortcut icon" type="image/png" href="../Images/android-chrome-512x512.png">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/signup.css">
    <link rel="stylesheet" href="../assets/css/material-dashboard.css">
    <script src="https://kit.fontawesome.com/e9de02addb.js" crossorigin="anonymous"></script>
</head>
<body >
 
  <div class="container z-index-sticky top-0 mb-5  ">
    <div class="row">
      <div class="col-12  ">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur border-radius-xl top-0 z-index-3 bg-dark shadow position-absolute my-3 py-2 start-0 end-0 mx-4 ">
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
                  <a class="nav-link title d-flex align-items-center me-2 active" aria-current="page" href="./about_us">
                    <i class="fa-solid fa-table-layout opacity-6 text-dark me-1 "></i>
                    About Us
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2 title" href="./about_us">
                    <i class="fa-duotone fa-circle-envelope opacity-6 text-dark me-1"></i>
                    Social Media
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2 title" href="./Signin">
                    <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
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
    
        <div class="container mt-5 col-lg-12 w-80 form-control ">
          <div class="card mt-5 bg-light ">
              <div class="card-body">
                  <div class="card-title text-center">
                      <h1>Create a Unibook account </h1>
                  </div>
                  <?php echo ErrorMessage(); echo SuccessMessage();?>

                <form action="app/signup.app.php " method="POST">
                  <div class="first">
                    <label for="">Firstname</label>
                    <input type="firstname" class="form-control" name="firstname" placeholder="first name">
                    <small class="text-danger ">Your names will appear on your certificate as supplied</small>
                </div>
                <div class="last ">
                    <label for="">Lastname</label>
                    <input type="lastname" class="form-control" name="lastname" placeholder="last name">
                    
                </div> 

                <div class="user">
                <label>Username</label>
                <input type="text" name="username"placeholder="username"  class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?> " >
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
                </div>

                <div class="phone">
                    <label for="">Phone number</label>
                    <input type="tel" class="form-control" name="phone" placeholder="phone eg.080874456644"  required>
                    
                </div>
                
                
                <div class="location mt-3"> 
                    <select class="form-select form-select-md" name="state" aria-label=".form-select-mg example">
                    <option selected> Your current location</option>
                    <option value="kaduna">kaduna</option>
                    <option value="niger">niger</option>
                    <option value="akure">FUTA</option>
                  </select>
                </div>
                <div class="school mt-3"> 
                    <select class="form-select form-select-md" name="school" aria-label=".form-select-mg example">
                    <option selected> Select Your School of Study</option>
                    <option value="1">Ahmedu Bello University</option>
                    <option value="2">FUTMINNA</option>
                    <option value="3">FUTA</option>
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
                    <input class="form-check-input" type="radio" name="gender"value="female" id="gender" checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Female
                    </label>
                  </div>
                </div>
                <div class="email">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="valid email" required>
                </div>
                <div class="password">
                  <label class="mt-3" for="">Create Password</label>
                  <input type="password" class="form-control<?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" name="password" id="Password" placeholder="create a password" required> <span class="invalid-feedback"><?php echo $password_err; ?> 8 characters minimum</span>
                  <span onclick="togglePass()"><i class="fa fa-eye-slash eye"></i></span>
                </div>
                <div class="confirm">
                    <label for="">Confirm Your Password</label>
                    <input type="password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" name="conpassword" id="Password" placeholder="confirm password" required>
                     <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    <!-- <span onclick="togglePass()"><i class="fa fa-eye-slash eye"></i></span> -->
          
                </div>
                <div class="mt-4">
                    <label for="">Date of birth</label>
                    <input type="date" class="form-control" name="dob" placeholder="" required>
                </div>
                <div class="referral">
                    <label for=""></label>
                    <input type="referral" class="form-control" name="refer" placeholder="How did you hear about us?" required>
                </div>
              <div class="mt-5"> 
                 <button class="btn btn-dark w-100" name="signup" type="submit"> Sign Up</div></button>
                <small class="text-center">By contiuning you confirm that you agree to the terms of use and confirm that you have read the <a href="#">privacy policy</a> </small>
            </div>
                </form>
              </div>
          </div>
      </div>


    </div> 
         <!-- footer  -->
      <div class="container-fluid bg- mt-5 ">
          <footer class="py-3 my-4 ">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3 ">
            <li class="nav-item"><a href="about_us" class="nav-link px-2 text-light">Home</a></li>
              <li class="nav-item"><a href="#" class="nav-link px-2 text-light">More Website</a></li>
              <li class="nav-item"><a href="donate" class="nav-link px-2 text-light">Donate</a></li>
              <li class="nav-item"><a href="faq" class="nav-link px-2 text-light">FAQs</a></li>
              <li class="nav-item"><a href="about_us" class="nav-link px-2 text-light">About Us</a></li>
            </ul>
            <p class="text-center text-light">&copy; 
              <script>
              document.write(new Date().getFullYear())
            </script> Testech, Ltd</p>
            
          </footer>
            </div>
      <!-- footer  -->
    <script src="https://kit.fontawesome.com/3252b22438.js" crossorigin="anonymous"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script> function togglePass() {
          var x = document.getElementById("Password");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
          }
          </script>
</body>
  
</html>