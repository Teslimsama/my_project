<?php include "session.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="Images/apple-touch-icon.png">
  <link rel="shortcut icon" type="image/png" href="Images/android-chrome-512x512.png">
  <title>
    Notifications || Unibooks
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
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Notifications</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Notifications</h6>
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
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="mt-4 card">
            <div class="card-header">
              <h5 class="mb-0">Unread Notifications</h5>
            </div>
            <div class='card-body pb-0'>

              <?php
              $query = $conn->prepare("SELECT * from `notifications` where `status` = 'unread' order by `date` DESC");
              $query->execute();
              if ($query->rowCount() > 0) {
                foreach ($query->fetchAll() as $i) {
              ?>


                  <?php
                  $link = $i['id'];
                  $alert = "
                        <div class='alert alert-secondary alert-dismissible' role='alert'> <span>";
                  $alert .= " <a class=' text-white' href='view?id=" . $link . "'>";
                  $alert .= htmlentities($i['message']);
                  $alert .= "</a></span>
              <button type='button' class='btn-close text-lg py-3 opacity-10' data-bs-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
              </button>
              </div>
     ";
                  if ($i['type'] == 'comment') {
                    echo $alert;
                  //   if (count(fetchAll($sql)) > 0) {
                  //     foreach (fetchAll($sql) as $i) {
                  //       echo "<hr> $alert";
                  // }}
                }
                  ?>


              <?php
                }
              } else {
                echo "<h3>No New Notifications Yet.</h3>";
              }
              ?>

            </div>
            </div>
          <div class="mt-4 card">
            <div class="card-header">
              <h5 class="mb-0">Read Notifications</h5>
            </div>
            <div class='card-body pb-0'>

              <?php
              
              $sql = $conn->prepare("SELECT * from `notifications` where `status` = 'read' order by `date` DESC");
              $sql->execute();
              if ($sql->rowCount() > 0) {
                foreach ($sql->fetchAll() as $i) {
              ?>


                  <?php
                  $link = $i['id'];
                  $alert = "
                        <div class='alert alert-secondary alert-dismissible' role='alert'> <span>";
                  $alert .= " <a class=' text-white' href='view?id=" . $link . "'>";
                  $alert .= htmlentities($i['message']);
                  $alert .= "</a></span>
              <button type='button' class='btn-close text-lg py-3 opacity-10' data-bs-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
              </button>
              </div>
     ";
                  if ($i['type'] == 'comment') {
                    echo $alert;
                  //   if (count(fetchAll($sql)) > 0) {
                  //     foreach (fetchAll($sql) as $i) {
                  //       echo "<hr> $alert";
                  // }}
                }
                  ?>


              <?php
                }
              } else {
                echo "<h3>No Read Notifications Yet.</h3>";
              }
              ?>

            </div>
            </div>
          </div>

          <?php include "footer.php" ?>


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