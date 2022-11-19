<?php include "assets/includes/session.php" ?>
<?php
include_once 'config/database.php';
require_once('app/component.php');

$num_pages = 5;
if (isset($_GET["page"])) {
  $page = $_GET["page"];
} else {
  $page = 1;
}
$startfrom = ($page - 1) * 5;



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="Images/apple-touch-icon.png">
  <link rel="shortcut icon" type="image/png" href="Images/android-chrome-512x512.png">

  <title>
    Project ||Unibooks
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <link href="assets/css/all.css" rel="stylesheet" />
  <link href="assets/css/solid.css" rel="stylesheet" />
  <link href="assets/css/brand.css" rel="stylesheet" />

  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/e9de02addb.js" crossorigin="anonymous"></script>
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9952650109664010" crossorigin="anonymous"></script>





  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/content.css">
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Project</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Project</h6>
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
          <?php include "assets/includes/navbar.php" ?>

        </div>
      </div>
    </nav>
    <main>
      <div class="doe">


        <?php
        // $result_pro = $database->getData();


        while ($row = mysqli_fetch_assoc($pro)) {
          procomponent($row['product_name'], $row['product_image'], $row['id']);
        }
        ?>
      </div>
      <STyle>
        .bd-example {
          /* margin-left: 00px; */
          display: flex;
          align-items: center;
          justify-content: center;
        }
      </STyle>

      <div class="bd-example mt-4 ">
        <nav aria-label="Standard pagination example">
          <ul class="pagination">
            <li class="page-item">
              <a class="page-link" href="javascript://history.go(-1)" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <?php
            $sqll = "SELECT * FROM project";

            $resultt = mysqli_query($db_connect, $sqll);
            $total_rec = mysqli_num_rows($resultt);
            $total_pages = ceil($total_rec / $num_pages);
            for ($i = 1; $i <= $total_pages; $i++) {
              echo "
             <li class='page-item'><a class='page-link' href='project?page=" . $i . "'>" . $i . "</a></li>
             ";
            }
            ?>


            <li class="page-item">
              <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>

    </main>


    <!-- footer  -->
    <?php include "assets/includes/footer.php" ?>

    <!-- footer  -->
  </main>
  <div class="fixed-plugin">
    <?php include "assets/includes/plugin.php" ?>

    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <!-- fontawesome css -->
    <script defer src="assests/css/all.js"></script>
    <script defer src="assets/css/solid.js"></script>
    <script defer src="assests/css/brands.js"></script>
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