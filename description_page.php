<?php
include "session.php";

include 'alert.message.php';

if (isset($_GET['id'])) {
  // Create a connection object
  $id = $conn->quote($_GET['id']); // Escape data to prevent SQL injection
  $sql = "SELECT * FROM producttb WHERE id=:id OR  productlink=:id";
  $statement = $conn->prepare($sql);
  $statement->execute(array(':id' => $_GET['id']));
  $row = $statement->fetch();
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
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/profile.css">
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Description</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Description</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
              <form action="search.php">
                <label class="form-label">Type here...</label>
              <input type="search" name="k" class="form-control">
              </form>
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">

            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
          </ul>
          </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row min-vh-80">
        <div class="col-12">
          <div class="card mt-4">
            <div class="card-header p-0 position-relative mt-4 mx-3 z-index-2">

              <!-- image here  -->

              <div class="pic bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3"><?php echo $row['product_name']; ?></h6>
              </div>
            </div>
            <div class="card-body row px-5">
              <div class="download col-12">
                <div class="perview ">

                  <a herf="#" class="mx-3 mt-2 butt btn btn-dark">preveiw</a>

                </div>
                <div class="preview mt-2 ">
                  <!-- <a href="unibooks_download/<?php echo $row['productlink']; ?>" download class="btn btn-dark">Download <i class="material-icons ms-1 opacity-10">download</i></a> -->
                  <a href="download_link.app.php?id=<?php echo $row['id']; ?>" class="btn btn-dark" name="download">

                    Download <i class="material-icons ms-1 opacity-10">download</i>
                  </a>
                  <!-- <button type="submit" class="btn btn-dark" name="download" onclick="parent.open('app/download_link.app.php?file=<?php echo $row['productlink']; ?>')">

                    Download <i class="material-icons ms-1 opacity-10">download</i>
                  </button> -->


                </div>

              </div>
              <div class="msg">

                <?php echo ErrorMessage();
                echo SuccessMessage(); ?>
              </div>
              <div class="col-12">
                <h3>ORIGIN AND DISTRIBUTION OF CROP</h3>

                <p>Most cultivated crop have one location or the other as a place or origin.
                  The origin of crops still in dispute as there are varying opinions that seems
                  to contradict other. It worth nothing that the origin of most of the crops have
                  Been oteneicated by notable scientist one of which is the Russian scientist known as Vavilow.</p>
                <p>
                  The distribution of crops varies from one climatic condition to another
                  Some of the climatic conditions support the growth and development of some crops while others don’t. it can therefore be concluded that climate conditions such as sun energy amount of rainfall, type of vegetation, soil type of humidity and the rest influences the distribution of crops in Nigeria and the whole world.
                  The distribution of the cultivated crops and those as weld varies
                  from one agricultural zone to another.</p>
                <p>The identification of such centers along was a valuable contribution for
                  giving breeders and agronomies clues as to where the source material can be found. However, Vavilov was not satisfied by merely stating the facts but used them to elaborate an exciting theory of great importance that has passed the test of time. The theory states that the great diversity of forms, varieties and species of particular plant in definite part of the world attests to the fact that the speciation process in geographically localized.</p>
                <p>
                  Centers of origin of cultivated plants are separated from one another by mountain chains, deserts or expanses of water that is theygave rise to independent, isolated agricultural civilizations. In most cases a particular genus or species is associated with a single cente, but some crops are associated with two or more centers or centers of origin, where the plant in questions takes the most diverse forms and was domesticated for the first time and secondary centers arising as a result of migrations of individual formstome and secondary centers arising as a result of migration of individual forms from the primary one e.g the primary centers of maize origin is in Mexico,whereas China serve as the secondary center of origin of tis wary varieties.</p>

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