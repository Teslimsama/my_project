<?php
include_once '../config/database.php';
include '../config/alert.message.php';
// nclude "assets/includes/session.php";
//  $download = ''; 
$download = $_POST['book'];
$student_id = $_SESSION['id'];

$now = new DateTime();
$timestamp = $now->getTimestamp();
$sql = "INSERT INTO download (customerid,book,timestamp) VALUES(?,?,?);";

$stmt = mysqli_stmt_init($db_connect);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, 'isi', $student_id, $download, $timestamp);


if (mysqli_stmt_execute($stmt)) {
  $_SESSION['success'] = "Your Download is been Processed";
} else {
  $_SESSION['error'] = 'Please Try Again';
}

?>
<?php
include_once 'config/database.php';

if (isset($_GET['id'])) {
  # code...
  $id = mysqli_real_escape_string($db_connect, $_GET['id']);
  $sql = "SELECT * FROM producttb WHERE id='$id'";
  $result = mysqli_query($db_connect, $sql) or die('bad query');
  $row = mysqli_fetch_assoc($result);
} else {
  header("location:index");
}
?>
<?php include "assets/includes/session.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../Images/apple-touch-icon.png">
  <link rel="shortcut icon" type="image/png" href="../Images/android-chrome-512x512.png">
  <title>
    More info || Unibooks
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/e9de02addb.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/profile.css">
</head>

<body class="g-sidenav-show  bg-gray-200">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="about_us" target="_blank">
        <img src="../Images/unibooks copy.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">UniBooks</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white " href="content">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="downloads">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">download</i>
            </div>
            <span class="nav-link-text ms-1">Downloads</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="payments">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Payments</span>
          </a>
        </li>


        <li class="nav-item">
          <a class="nav-link text-white " href="notifications">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">notifications</i>
            </div>
            <span class="nav-link-text ms-1">Notifications</span>
            <?php
            $query = "SELECT * from `notifications` where `status` = 'unread' order by `date` DESC";
            if (count(fetchAll($query)) > 0) {
            ?>
              <span class="position-absolute top-45 start-80 translate-middle badge rounded-pill bg-dark"><?php echo count(fetchAll($query)); ?></span>

            <?php
            }
            ?>

          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white " href="profilepage">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="logout">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-arrow-right-from-bracket opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Log Out</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Coming Soon...</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="assignment">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">assignment</i>
            </div>
            <span class="nav-link-text ms-1">assignment</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="assignment">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">book</i>
            </div>
            <span class="nav-link-text ms-1">Project</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        <a class="btn bg-gradient-primary mt-4 w-100" href="#" type="button">be a unibooker</a>
      </div>
    </div>
  </aside>
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
              <label class="form-label">Type here...</label>
              <input type="search" class="form-control">
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
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">

              <!-- image here  -->
              <form action="" method="POST">
                <div class="pic bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                  <h6 class="text-white text-capitalize ps-3">Crop Production</h6>
                </div>
            </div>
            <div class="card-body px-5">
              <div class="download">
                <div class="perview ">

                  <a herf="#" class="mx-3 mt-2 butt btn btn-dark">preveiw</a>

                </div>
                <div class="preview mt-2">
                  <input type="hidden" name="book" value="crop_production" id="download">
                  <!-- Button trigger modal -->
                  <button type="submit" class="btn btn-dark" name="download" onclick="parent.open('../app/download_link.app.php?file=<?php echo $row['productlink']; ?>')" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Download <i class="material-icons ms-1 opacity-10">download</i>
                  </button>


                </div>

                </form>

              </div>
              <div class="msg">

                <?php echo ErrorMessage();
                echo SuccessMessage(); ?>
              </div>
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
        <style>
          .download {
            display: grid;
            grid-template: 40px 20px / 200px 300px;
          }

          @media screen and (max-width:320px) {
            .download {
              display: grid;
              grid-template: 70px 20px / 120px 300px;
            }

          }
        </style>


      </div>
    </div>
    </div>
    <!-- </div>
    </div> -->
    <div class="container-fluid py-4">
      <!-- footer  -->
      <div class="container-fluid bg- mt-5 ">
        <footer class="py-3 my-4 ">
          <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="about_us" class="nav-link px-2 text-light">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-light">More Website</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-light">Donate</a></li>
            <li class="nav-item"><a href="faq" class="nav-link px-2 text-light">FAQs</a></li>
            <li class="nav-item"><a href="about_us" class="nav-link px-2 text-light">About Us</a></li>
          </ul>
          <p class="text-center text-muted">&copy;
            <script>
              document.write(new Date().getFullYear())
            </script> Testech, Ltd
          </p>

        </footer>
      </div>
      <!-- footer  -->
    </div>
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="material-icons py-2">settings</i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Material UI Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="material-icons">clear</i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3 d-flex">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-3">
        <div class="mt-2 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <a class="btn bg-gradient-info w-100" href="https://www.creative-tim.com/product/material-dashboard-pro">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/material-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Material%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer?u=https://www.creative-tim.com/product/material-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
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
  <script src="../assets/js/material-dashboard.min.js?v=3.0.4"></script>
</body>

</html>