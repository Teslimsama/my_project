<?php include "session.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="https://unibooks.com.ng/Images/apple-touch-icon.png">
  <link rel="shortcut icon" type="image/png" href="https://unibooks.com.ng/Images/android-chrome-512x512.png">

  <title>
    Project || Unibooks
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />


  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/e9de02addb.js" crossorigin="anonymous"></script>


  <script async src="https://page.phpad2.googlesyndication.com/page.phpad/js/adsbygoogle.js?client=ca-pub-9952650109664010" crossorigin="anonymous"></script>



  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="page.phpstyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/content.css">
</head>

<body class="g-sidenav-show ">
  <?php
  include 'sidebar.php' ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page.php">Dashboard</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Dashboard</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <form action="search" method="GET">
            <div class="input-group input-group-outline">
              <label class="form-label">Type here...</label>
              <input type="text" id="search"  name="k" class="form-control">

            </div>
            </form>
          </div>
          <?php include "navbar.php" ?>

        </div>
      </div>
    </nav>
    <main>
      <form action="" method="POST">

        <div class="doe" id="post_data"></div>

      </form>

      <div id="pagination_link"></div>

      <?php include "footer.php" ?>
    </main>
    <?php include "plugin.php" ?>
    <script>
      load_data();

      function load_data(query = "", page_number = 1) {
        var form_data = new FormData();

        form_data.append("query", query);

        form_data.append("page", page_number);

        var ajax_request = new XMLHttpRequest();

        ajax_request.open("POST", "process_data_pro.php");

        ajax_request.send(form_data);

        ajax_request.onreadystatechange = function() {
          if (ajax_request.readyState == 4 && ajax_request.status == 200) {
            var response = JSON.parse(ajax_request.responseText);

            var html = "";

            var serial_no = 1;

            if (response.data.length > 0) {
              for (var count = 0; count < response.data.length; count++) {
                html += `
      <div class='pic card bg-gradient-light mt-3'>
          <img class='' src='` + response.data[count].image + `' height='' alt='book_pics' style='width: 100%;'>
          <div class='over'>
            <a id='download' class='alert ' href='` + response.data[count].link + `'><i class='fa-solid fa-download'></i></a>
          </div>
          <input type='hidden' name= '` + response.data[count].id + `'>
          <a href='description_pro?id=` + response.data[count].id + `'>
            <div class='container name '>
              <h6>` + response.data[count].name + `</h6>
              
          </a>
        </div>
      </div> 
        `;
                serial_no++;
              }
            } else {
              html +=
                '<h3 class="text-center">No Data Found</h3>';
            }

            document.getElementById("post_data").innerHTML = html;

            // document.getElementById("total_data").innerHTML = response.total_data;

            document.getElementById("pagination_link").innerHTML = response.pagination;
          }
        };
      }
    </script>
    <script>
      var win = navigator.platform.indexOf('Win') > -1;
      if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
          damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
      }
    </script>
    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>


    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example page.phps etc -->
    <script src="assets/js/material-dashboard.min.js?v=3.0.4"></script>
</body>

</html>