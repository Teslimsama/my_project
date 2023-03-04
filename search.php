<?php include "session.php" ?>
<?php $i = ''; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="Images/apple-touch-icon.png">
  <link rel="shortcut icon" type="image/png" href="Images/android-chrome-512x512.png">
  <title>
    Search || Unibooks
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
  <!-- <link rel="stylesheet" href="assets/css/search.css"> -->
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Search</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Search</h6>
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
      </div>
    </nav>
    <!-- End Navbar -->

    <main class="">
      <div class="search-wrapper">
        <div class="input-holder">
          <form action="search" method="GET">

            <input type="text" name="k" class="search-input" placeholder="Type to search" />
            <button class="search-icon" type="submit" onclick="searchToggl(this, event);"><span></span></button>
          </form>
        </div>
        <span class="close" onclick="searchToggl(this, event);"></span>
      </div>
    </main>
    <div class="result card p-4">

      <?php


      $k = $_GET['k'];
      $terms = explode(" ", $k);
      $sql = " SELECT * FROM search WHERE ";


      foreach ($terms as $each) {
        $i++;
        if ($i == 1)
          $sql .= "keywords LIKE '%$each%' ";
        else
          $sql .= " OR keywords LIKE '%$each%' ";
      }

      $query = $conn->prepare($sql);
      $query->execute();
      $numrows = $query->rowCount();
      if ($numrows > 0) {
        while ($row = $query->fetch()) {
          $id = $row['id'];
          $title = $row['title'];
          $descrip = $row['description'];
          $key = $row['keywords'];
          $link = $row['link'];


          echo "<h4><a href='description_page?id=$link'>$title</a></h4> $descrip  <br /> <hr> ";
        }
      } else {
        echo "No results found for \"<b>$k</b>\" ";
      }


      ?>
    </div>

    </div>






  </main>
  <?php include "footer.php" ?>
  <?php include "plugin.php" ?>


  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="assets/js/ajax.js"></script>
  <script>
    function searchToggl(obj, evt) {
      var container = $(obj).closest('.search-wrapper');
      if (!container.hasClass('active')) {
        container.addClass('active');
        evt.preventDefault();
      } else if (container.hasClass('active') && $(obj).closest('.input-holder').length == 0) {
        container.removeClass('active');
        // clear input
        container.find('.search-input').val('');
      }
    }

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