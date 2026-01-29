<?php
include "session.php"; // Ensure this file starts the session and initializes the $user variable

if (!isset($_SESSION['user'])) {
  header('location: index.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "meta.php" ?>
  <title>Profile page || Unibooks</title>
  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/e9de02addb.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet">
  <link id="pagestyle" href="assets/css/profile.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/app.css">
  <link rel="stylesheet" href="assets/css/owl.carousel.css">
  <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
  <style>
    .owl-carousel .item {
      position: relative;
      padding: 15px;
    }

    .owl-carousel .item img {
      width: 100%;
      height: auto;
      border-radius: 15px;
    }
  </style>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/owl.carousel.js"></script>
</head>

<body class="bg-light">
  <?php include "header_app.php"; ?>

  <div class="main-content container-fluid py-4">
    <!-- End Navbar -->
    <div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('assets/Images/pexels-engin-akyurt-2943603_24685434.jpg');">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>
      <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row gx-4 mb-2">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="<?php echo (!empty($user['image'])) ? $user['image'] : 'noimage.jpg'; ?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                <?php echo $user['firstname'] . ' ' . $user['lastname']; ?>
              </h5>
              <p class="mb-0 font-weight-normal text-sm">
                Student
              </p>
            </div>
          </div>
        </div>
        <div class="row gx-4 mb-2">
          <div class="col-12 col-xl-4">
            <div class="card card-plain h-100">
              <div class="card-header pb-0 p-3">
                <div class="row">
                  <div class="col-sm-8 d-flex align-items-center">
                    <h6 class="mb-0">Profile Information</h6>
                  </div>
                  <div class="col-sm-4 text-end">
                    <a href="update_details">
                      <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                    </a>
                  </div>
                </div>
                <div class="col-md-12">
                  <?php echo ErrorMessage();
                  echo SuccessMessage(); ?>
                </div>
              </div>
              <div class="card-body p-3">
                <ul class="list-group">
                  <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; <?php echo $user['firstname'] . ' ' . $user['lastname']; ?>
                  <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Username:</strong> &nbsp; <?php echo $user['username']; ?></li>
                  <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong> &nbsp; <?php echo $user['phone']; ?></li>
                  <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; <?php echo $user['email']; ?></li>
                  <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">University:</strong> &nbsp; <?php echo $user['school']; ?></li>
                  <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Level:</strong> &nbsp; <?php echo $user['level']; ?></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 mt-4">
          <div class="mb-5 ps-3">
            <h6 class="mb-1">Relevant Books For You</h6>
            <p class="text-sm">These Books May Prove Useful</p>
          </div>
          <div class="owl-carousel owl-theme">
            <?php
            $faculty = $user['faculty'];
            $department = $user['department'];
            $level = $user['level'];
            $sql = "SELECT * FROM producttb WHERE faculty LIKE '%$faculty%' OR department LIKE '%$department%' OR level LIKE '%$level%'";
            $query = $conn->prepare($sql);
            $query->execute();
            $numrows = $query->rowCount();
            if ($numrows > 0) {
              while ($row = $query->fetch()) {
                $id = $row['id'];
                $title = $row['product_name'];
                $image = $row['product_image'];
                echo '
            <div class="item">
              <div class="card card-blog card-plain">
                <div class="card-header p-0 mt-n4 mx-3">
                  <a class="d-block shadow-xl border-radius-xl">
                    <img src="' . (!empty($image) ? "./unibooks_download/" . $image : '/assets/Images/noimage.jpg') . '" alt="' . $title . '" class="img-fluid shadow border-radius-xl">
                  </a>
                </div>
                <div class="card-body p-3">
                  <a href="description_page?id=' . $id . '">
                    <h5>' . $title . '</h5>
                  </a>
                </div>
              </div>
            </div>';
              }
            } else {
              echo "No results found, please update your information.";
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    <script>
      $(document).ready(function() {
        $('.owl-carousel').owlCarousel({
          margin: 10,
          nav: true,
          loop: true,
          responsive: {
            0: {
              items: 1
            },
            600: {
              items: 3
            },
            1000: {
              items: 5
            }
          }
        });
      });
    </script>
    <?php include "footer.php" ?>
  </div>

  <?php include "bottom_nav_app.php"; ?>

  <?php include "plugin.php" ?>

  <!-- Core JS Files -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="https://kit.fontawesome.com/e9de02addb.js" crossorigin="anonymous"></script>
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