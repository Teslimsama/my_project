<?php include "session.php" ?>


<!DOCTYPE html>
<html lang="en">

<head>

  <?php include "meta.php" ?>
  <title>
    About Us || Unibooks
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
  <link rel="stylesheet" href="assets/css/faq.css">
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">About Us</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">About Us</h6>
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
    </nav>
    <!-- End Navbar -->
    <div class="container ">
      <div class="row ">
        <div class="col-12">
          <div class="card mt-4 container-fluid ">
            <div class="card-body px-5">
              <h2>About Us</h2>


              <p>

                Welcome to our website! We are a dedicated platform designed exclusively for university students, providing a range of services to support their academic journey. Our mission is to empower students by offering convenient access to educational resources, opportunities to buy and sell books and projects, and connections with individuals who can assist with assignments.
              </p>
              <p>

                At our core, we believe that every student should have equal access to educational materials. That's why we offer a vast collection of digital books available for free download. Our comprehensive library covers a wide range of subjects, ensuring that students can find the resources they need to excel in their studies. We aim to make learning accessible, affordable, and convenient for all.
              </p>
              <p>

                In addition to free book downloads, we provide a platform for students to buy and sell books and projects. We understand the financial challenges faced by students and aim to create a marketplace that facilitates fair transactions. Whether you're looking to sell your used books or find affordable textbooks for your upcoming semester, our platform connects buyers and sellers, making the process efficient and cost-effective.
              </p>
              <p>

                We also recognize that students may occasionally require assistance with their assignments. Our website serves as a meeting place for students seeking help and knowledgeable individuals willing to offer their expertise. Through our platform, you can post assignment requests and receive proposals from experienced individuals who can lend their support. We encourage open communication and collaboration to ensure that students receive the assistance they need while fostering a culture of academic integrity.
              </p>
              <p>

                At the heart of our service is a commitment to quality and reliability. We strive to provide a seamless and secure user experience, ensuring that transactions and interactions on our platform are conducted safely. We have implemented robust systems to protect your personal information and maintain a high standard of content quality.
              </p>
              <p>

                We are passionate about supporting students throughout their academic journey and helping them achieve their goals. Whether you're looking for educational resources, buying or selling books, or seeking assistance with assignments, our website is here to simplify the process and connect you with a vibrant community of students and academic professionals.
              </p>
              <p>

                Join our community today and unlock the resources and support you need to succeed in your studies. We are excited to have you on board and look forward to being a valuable partner in your educational pursuits.
              </p>
              <p>

                If you have any questions or need further assistance, please don't hesitate to contact our friendly customer support team. Thank you for choosing our website, and we wish you all the best in your academic endeavors!
              </p>
            </div>
          </div>
        </div>
      </div>

    </div>

    <?php include "footer.php" ?>

    <!-- footer  -->
  </main>
  <?php include "plugin.php" ?>

  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
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