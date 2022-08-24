
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../Images/apple-touch-icon.png">
  <link rel="shortcut icon" type="image/png" href="../Images/android-chrome-512x512.png">
  <title>
    Profile page || Unibooks
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
            <div class="container mt-5 col-lg-12 w-50 form-control ">
                <div class="card mt-5 bg-light ">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-center text-capitalize ps-3">Update Your Details</h6>
              
              </div>
            </div>
                    <div class="card-body">
                    <form action="app/forgotten.app.php " method="POST">

                <div class="user">
                <label>Username</label>
                <input type="text" name="username"  class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" >
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
                </div>

                
                
                <div class="form-group">
                <input type="submit" class="btn btn-primary"name="submit" value="Submit">
                <a class="btn btn-link ml-2" href="profilepage">Cancel</a>
                </div>
            </form>
            </div>
        </div>
    </div>
          
</body>
</html>