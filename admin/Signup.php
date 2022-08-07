<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/signup.css">
    <link rel="stylesheet" href="../assets/css/material-dashboard.css">
</head>
<body >
 
  <div class="container z-index-sticky top-0 mb-5  ">
    <div class="row">
      <div class="col-12  ">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur border-radius-xl top-0 z-index-3 bg-dark shadow position-absolute my-3 py-2 start-0 end-0 mx-4 ">
          <div class="container-fluid ps-2 pe-0">
            <a href="../Images/unibooks copy.png"> <img class="me-3 " src="../Images/unibooks copy.png" alt="" width="50"></a>
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="./about_us.html" target="_blank">
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
                  <a class="nav-link title d-flex align-items-center me-2 active" aria-current="page" href="./content.html">
                    <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                    Dashboard
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2 title" href="./profilepage.html">
                    <i class="fa fa-user opacity-6 text-dark me-1"></i>
                    Profile
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2 title" href="./Signin.html">
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
    
        <div class="container mt-5 col-lg-12  form-control ">
          <div class="card mt-5 bg-light ">
              <div class="card-body">
                  <div class="card-title text-center">
                      <h1>Create a Unibook account </h1>
                  </div>
                <form action="" method="post">
                  <div class="first">
                    <label for=""></label>
                    <input type="firstname" class="form-control" placeholder="first name">
                    <small class="text-danger ">Your names will appear on your certificate as supplied</small>
                </div>
                <div class="last ">
                    <label for=""></label>
                    <input type="lastname" class="form-control" placeholder="last name">
                    
                </div> 
                <div class="first">
                    <label for=""></label>
                    <input type="tel" class="form-control" placeholder="phone eg.08079730127">
                    
                </div>
                <div class="level">
                    <label for=""></label>
                    <input type="text" class="form-control" placeholder="Current Level">
                    
                </div>
                <div class="faculty">
                    <label for=""></label>
                    <input type="text" class="form-control" placeholder="faculty">
                    
                </div>
                <div class="Department">
                    <label for=""></label>
                    <input type="tel" class="form-control" placeholder="Department">
                    
                </div>
                <div class="course">
                    <label for=""></label>
                    <input type="tel" class="form-control" placeholder="Course of Study">

                <div class="School mt-3"> 
                    <select class="form-select form-select-md" aria-label=".form-select-mg example">
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
                    <label for=""></label>
                    <input type="email" class="form-control" placeholder="valid email" required>
                </div>
                <div class="password">
                    <label class="mt-3" for="">Create Password: 8 characters minimum</label>
                    <input type="password" class="form-control" placeholder="create a password" required>
                </div>
                <div class="confirm">
                    <label for=""></label>
                    <input type="password" class="form-control" placeholder="confirm password" required>
                </div>
                <div class="mt-4">
                    <label for="">Date of birth</label>
                    <input type="date" class="form-control" placeholder="">
                </div>
                <div class="referral">
                    <label for=""></label>
                    <input type="referral" class="form-control" placeholder="How did you hear about us?">
                </div>
              <div class="mt-5"> 
                 <button class="btn btn-dark w-100" type="submit"> Submit</div></button>
                <small class="text-center">By contiuning you confirm that you agree to the terms of use and confirm that you have read the <a href="#">privacy policy</a> </small>
            </div>
                </form>
              </div>
          </div>
      </div>


    </div> 
               <!-- footer -->

    

    <div class="container-fluid bg- ">
      <footer class="py-3 my-4 ">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
          <li class="nav-item"><a href="#" class="nav-link px-2 text-light">Home</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-light">Features</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-light">Pricing</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-light">FAQs</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-light">About</a></li>
        </ul>
        <p class="text-center text-light">&copy; 2022 Testech, Ltd</p>
      </footer>
    <script src="https://kit.fontawesome.com/3252b22438.js" crossorigin="anonymous"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
  
</html>