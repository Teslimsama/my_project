<?php include "session.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <?php include "meta.php" ?>
  <title>
    Donate || UniBooks Nigeria
  </title>
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
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
  <link id="pagestyle" href="assets/css/faq.css" rel="stylesheet" />
  <!-- <link rel="stylesheet" href="assets/css/cheatsheet.css"> -->
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9952650109664010" crossorigin="anonymous"></script>
</head>

<body class="g-sidenav-show  bg-gray-200">
  <?php include 'sidebar.php' ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="index">Home</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Donate</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Donate</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <form action="search" method="GET">
              <div class="input-group input-group-outline">
                <label class="form-label">Type here...</label>
                <input type="text" name="k" class="form-control">

              </div>
            </form>
          </div>
          <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
              </div>
            </a>
          </li>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid pay mt-3 py-4">
      <div class="row min-vh-80">
        <div class="col-6 mx-auto">
          <div class="card mt-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-center text-capitalize ps-3">You can donate here !</h6>

              </div>
            </div>
            <div class="card-body">
              <div class="msg">
                <?php echo ErrorMessage();
                echo SuccessMessage(); ?>
              </div>
              <h6>Your donation will really go long way in helping me pursue my career, Please any amount is a life changer</h6>
              <form action="transact_initialize.php" method="POST">
                <div class="input-group input-group-outline my-3">
                  <label for="email">Email Address</label>
                  <input class="form-control w-100" type="email" id="email" name="email" required />
                </div>
                <div class="input-group input-group-outline my-3">
                  <label for="amount">Amount</label>
                  <input type="number" class="form-control w-100" id="amount" name="amount" required />
                </div>
                <div class="input-group input-group-outline my-3">
                  <label for="first-name">First Name</label>
                  <input type="text" class="form-control w-100" id="firstname" name="firstname" />
                </div>
                <div class=" input-group input-group-outline my-3">
                  <label for="last-name">Last Name</label>
                  <input type="text" class="form-control w-100" id="lastname" name="lastname" />
                </div>
                <div class=" input-group input-group-outline my-3">
                  <label for="phone">Phone Number</label>
                  <input type="tel" class="form-control w-100" id="phone" name="phone" />
                </div>
                <div class="form-submit justify-center">
                  <button class="btn btn-large btn-dark mt-4" type="submit"> Buy Me Card </button>
                  <!-- <button class="btn btn-large btn-dark mt-4" type="submit" onclick="payWithPaystack()"> Buy Me Card </button> -->
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include "footer.php" ?>

    </div>
  </main>
  <?php include "plugin.php" ?>

  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="a"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.min.js?v=3.0.4"></script>
</body>

</html>