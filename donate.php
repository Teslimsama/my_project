<?php include "assets/includes/session.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/imgages/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/imgages/favicon.png">
  <title>
    Donate || UniBooks
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
  <link id="pagestyle" href="assets/css/faq.css" rel="stylesheet" />
  <!-- <link rel="stylesheet" href="assets/css/cheatsheet.css"> -->
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9952650109664010" crossorigin="anonymous"></script>
</head>

<body class="g-sidenav-show  bg-gray-200">
  <?php include 'assets/includes/sidebar.php' ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
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
        <div class="col-12 mx-auto">
          <div class="card mt-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-center text-capitalize ps-3">You can donate here !</h6>

              </div>
            </div>
            <div class="card-body">
              <h6>Your donation will really go long way in helping me pursue my career, Please any amount is a life changer</h6>
              <form id="paymentForm">
                <div class="input-group input-group-outline my-3">
                  <label for="email">Email Address</label>
                  <input class="form-control w-100" type="email" id="email-address" required />
                </div>
                <div class="input-group input-group-outline my-3">
                  <label for="amount">Amount</label>
                  <input type="tel" class="form-control w-100" id="amount" required />
                </div>
                <div class="input-group input-group-outline my-3">
                  <label for="first-name">First Name</label>
                  <input type="text" class="form-control w-100" id="first-name" />
                </div>
                <div class="input-group input-group-outline my-3">
                  <label for="last-name">Last Name</label>
                  <input type="text" class="form-control w-100" id="last-name" />
                </div>
                <div class="form-submit justify-center">
                  <button class="btn btn-large btn-dark mt-4" type="submit" onclick="payWithPaystack()"> Buy Me Card </button>
                </div>
              </form>

              <script src="https://js.paystack.co/v1/inline.js"></script>
            </div>
          </div>
        </div>
      </div>
    </div>
    <style>
      /*      
       .pay{
         display: flex;
       justify-content: space-around;
       align-items: center;
       margin-top: 250px;
       margin-left: 30em; 
       } */

      /* .pay {
        width: 50em;

      }

      @media screen and (max-width:575.98px) {
        body {
          background-image: url(assets/css/pexels-artem-beliaikin-1153976.jpg);
          background-size: cover;
          background-repeat: no-repeat;
          height: 100%;

        }
      } */
    </style>
    <script>
      const paymentForm = document.getElementById('paymentForm');
      paymentForm.addEventListener("submit", payWithPaystack, false);

      function payWithPaystack(e) {
        e.preventDefault();

        let handler = PaystackPop.setup({
          key: 'pk_test_3d44964799de7e2a5abdbf2eef2fbe6852e60833', // Replace with your public key
          email: document.getElementById("email-address").value,
          amount: document.getElementById("amount").value * 100,
          firstname: document.getElementById("first-name").value,
          lastname: document.getElementById("last-name").value,
          ref: 'unibook' + Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
          // label: "Optional string that replaces customer email"
          onClose: function() {
            // window.location
            alert('Window closed.');
          },
          callback: function(response) {
            let message = 'Payment complete! Reference: ' + response.reference;
            alert(message);

            window.location = "http://localhost/my_project/transact_verify?reference=" + response.reference;

          }
        });

        handler.openIframe();
      }
    </script>
    <?php include "assets/includes/footer.php" ?>

    </div>
  </main>
  <?php include "assets/includes/plugin.php" ?>

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