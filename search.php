<?php include "session.php" ?>
<?php $i = ''; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "meta.php" ?>
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
  <link rel="stylesheet" href="assets/css/app.css">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9952650109664010" crossorigin="anonymous"></script>

</head>

<body class="bg-light">
  <?php include "header_app.php"; ?>

  <main class="container-fluid pb-5">
    <div class="d-md-none p-3">
      <div class="search-container m-0">
        <i class="fa fa-search search-icon"></i>
        <form action="search" method="GET" class="m-0">
          <input type="text" name="k" class="search-input" placeholder="Search...">
        </form>
      </div>
    </div>
    <!-- End Navbar -->

    <div class="result card p-4 shadow-sm border-radius-lg">
      <?php
      if (isset($_GET['k'])) {
        $k = $_GET['k'];
        $terms = explode(" ", $k);
        $conditions = [];
        $params = [];

        foreach ($terms as $index => $each) {
          if (!empty($each)) {
            $conditions[] = "keywords LIKE :term$index";
            $params[":term$index"] = "%$each%";
          }
        }

        if (!empty($conditions)) {
          $sql = "SELECT * FROM search WHERE " . implode(" OR ", $conditions);
          $query = $conn->prepare($sql);
          $query->execute($params);
          $numrows = $query->rowCount();

          if ($numrows > 0) {
            echo "<h5 class='mb-4 text-muted small'>Found $numrows matches for \"$k\"</h5>";
            while ($row = $query->fetch()) {
              $title = htmlspecialchars($row['title']);
              $descrip = htmlspecialchars($row['description']);
              $link = $row['link'];
              echo "<div class='search-item mb-4'>
                      <h5 class='mb-1'><a href='description_page?id=$link' class='text-primary'>$title</a></h5>
                      <p class='text-muted small mb-0'>$descrip</p>
                    </div><hr class='my-3'>";
            }
          } else {
            echo "<div class='text-center py-5'>
                    <i class='fa-solid fa-magnifying-glass fs-1 text-light mb-3'></i>
                    <p class='text-muted'>No results found for \"<b>$k</b>\"</p>
                  </div>";
          }
        } else {
          echo "<p class='text-muted'>Please enter a search term.</p>";
        }
      } else {
        echo "<p class='text-muted'>Search for books or resources.</p>";
      }
      ?>
    </div>

    </div>






    <?php include "footer.php" ?>
  </main>

  <?php include "bottom_nav_app.php"; ?>
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