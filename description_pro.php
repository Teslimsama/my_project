<?php include "session.php";
// include 'alert.message.php';


if (isset($_GET['id'])) {
  // Create a connection object
  $id = $conn->quote($_GET['id']); // Escape data to prevent SQL injection
  $sql = "SELECT * FROM producttb WHERE id=:id";
  $statement = $conn->prepare($sql);
  $statement->execute(array(':id' => $_GET['id']));
  $row = $statement->fetch();
  $productID = $row['product_name'];
  $query = "SELECT * FROM producttb p
            LEFT JOIN search s ON p.product_name = s.title
            WHERE s.title = :product_name
            LIMIT 1";
  $statement = $conn->prepare($query);
  $statement->bindParam(':product_name', $productID, PDO::PARAM_STR_CHAR);
  $statement->execute();

  $result = $statement->fetch(PDO::FETCH_ASSOC);
} else {
  header("location:index");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="Images/apple-touch-icon.png">
  <link rel="shortcut icon" type="image/png" href="Images/android-chrome-512x512.png">
  <title>
    More info || Unibooks
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
  <link id="page.phpstyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/content.css">
  <link rel="stylesheet" href="assets/css/app.css">
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
    </div>
    </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row min-vh-80">
        <div class="col-12">
          <div class="card mt-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">

              <!-- image here  -->

              <div class="pic bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3"><?php echo $row['product_name']; ?></h6>
              </div>
            </div>
            <div class="card-body row px-5">
              <div class="msg">
                <?php echo ErrorMessage();
                echo SuccessMessage(); ?>
              </div>
              <div class=" row col-12">
                <div class="col-lg-3 col-sm-6">
                  <a href="transact_initialize_pro?id=<?php echo $row['id'] ?>" name="download"><button class="btn btn-dark">Download <i class="material-icons ms-1 opacity-10">download</i></button>

                  </a>
                </div>
                <a href="pdf_preview.php?id=<?php echo htmlspecialchars($row['id'] ?? ''); ?>" class="btn btn-info" name="preview">
                  Preview PDF <i class="material-icons ms-1 opacity-10">picture_as_pdf</i>
                </a>
              </div>
            </div>
            <div class="col-12">
              <?php echo htmlspecialchars($result['description'] ?? ''); ?>
            </div>
          </div>
        </div>
      </div>



    </div>
    </div>
    </div>
    <!-- </div>
    </div> -->
    <?php include "footer.php" ?>
  </main>

  <?php include "bottom_nav_app.php"; ?>

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