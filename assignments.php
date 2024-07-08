<?php include "session.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "meta.php" ?>
  <title>
    Assignment || Unibooks
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Assignment</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Assignment</h6>
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
          <?php include "navbar.php" ?>

        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="card container-fluid ">
      <div class="card-body px-5">
        <h2>Assignment Features - Coming Soon</h2>


        <p>

          We are excited to announce that we will soon be launching a new feature on our platform to support students with their assignments. At our core, we strive to provide comprehensive resources and services that cater to the diverse needs of university students.
        </p>
        <p>

          Our upcoming assignment feature aims to connect students with experienced individuals who can provide assistance and guidance on their assignments. Whether you need help with research, writing, proofreading, or formatting, our platform will facilitate the process of finding the right expert for your specific requirements.
        </p>

        <p>

          Key features of our upcoming assignment service will include:
        </p>

        <p>

          <strong>1. Expert Assistance:</strong> Gain access to a pool of qualified individuals with expertise in various academic fields. Our platform will enable you to connect with professionals who can provide valuable insights and support to enhance the quality of your assignments.
        </p>
        <p>

          <strong>2. Customized Support:</strong> We understand that each assignment is unique, and our platform will allow you to find the right person who can tailor their assistance to match your specific needs. From topic selection to comprehensive guidance, our experts will work closely with you to ensure your assignments meet the highest standards.
        </p>
        <p>

          <strong>3. Secure Communication: </strong>Our platform will provide a secure and convenient communication channel between students and assignment experts. You can discuss project details, share files, and collaborate effectively to achieve the desired outcomes.
        </p>
        <p>
          <strong>
            4. Transparent Pricing:</strong> We believe in fairness and transparency. The assignment feature will include a clear pricing structure, enabling you to choose the assistance that fits your budget. You will have the freedom to compare offers from different experts and select the one that suits your requirements.
        </p>
        <p>

          We are diligently working on finalizing the development of our assignment feature and ensuring it meets the highest quality standards. While we cannot provide an exact launch date at this time, we assure you that it will be available soon.
        </p>

        <p>Stay tuned for further updates and announcements regarding the launch of our assignment feature. We are committed to supporting you in your academic journey and providing the tools you need to succeed.
        </p>
        <p>
          If you have any questions or suggestions regarding our upcoming assignment feature, please feel free to reach out to our customer support team. We value your feedback and are excited to bring this new feature to our platform to further enhance your experience with us.</p>
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