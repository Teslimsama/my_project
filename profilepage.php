<?php include "session.php";
include 'alert.message.php';
if (!isset($_SESSION['user'])) {
  header('location: index.php');
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
    Profile page || Unibooks
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="httpitems://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="httpitems://kit.fontawesome.com/e9de02addb.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="httpitems://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet">
  <link id="pagestyle" href="assets/css/profile.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/owl.carousel.css">
  <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/owl.carousel.js"></script>
</head>

<body class="g-sidenav-show bg-gray-200">
  <?php include 'sidebar.php' ?>

  <div class="main-content position-relative max-height-vh-100 h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Profile</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Profile</h6>
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
    <div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('Images/pexels-engin-akyurt-2943603.jpg');">
        <span class="mask  bg-gradient-primary  opacity-6"></span>
      </div>
      <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row gx-4 mb-2">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="pfp/<?php echo $user['image']; ?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
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
              <div class=" col-md-12">
                <?php echo ErrorMessage();
                echo SuccessMessage(); ?></div>
            </div>
            <div class="card-body p-3">

              <ul class="list-group">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; <?php echo $user['firstname'] . ' ' . $user['lastname']; ?>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Username:</strong> &nbsp; <?php echo $user['username']; ?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong> &nbsp; <?php echo $user['phone']; ?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; <?php echo $user['email']; ?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">University:</strong> &nbsp; <?php echo $user['school']; ?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Level:</strong> &nbsp; <?php echo $user['level']; ?>L</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-12 mt-4">
          <div class="mb-5 ps-3">
            <h6 class="mb-1">Relevant Books For You</h6>
            <p class="text-sm">This Books May Prove Useful</p>
          </div>
          <div class="row owl-carousel owl-theme owl-loaded owl-drag">
            <?php
            $faculty = $user['faculty'];
            $department = $user['department'];
            $level = $user['level'];
            $sql = " SELECT * FROM producttb WHERE faculty LIKE '%$faculty%' OR department LIKE '%$department%' OR level LIKE '%$level%'";
            $query = $conn->prepare($sql);
            $query->execute();
            $numrows = $query->rowCount();
            // print_r($numrows);
            if ($numrows > 0) {
              while ($row = $query->fetch()) {
                $id = $row['id'];
                $title = $row['product_name'];
                // $descrip = $row['description'];
                $image = $row['product_image'];
                $link = $row['productlink'];


                echo '
                <div class="col-xl-6 col-md-12 mb-xl-0 mb-4 ">
              <div class="card card-blog card-plain">
                <div class="card-header p-0 mt-n4 mx-3">
                  <a class="d-block shadow-xl border-radius-xl">
                    <img src="Images/' . $image . '" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                  </a>
                </div>
                <div class="card-body p-3">
                  <!-- <p class="mb-0 text-sm">category</p> -->
                  <a href="description_page?id=' . $id . '">
                    <h5>
                      ' . $title . '
                    </h5>
                  </a>
                  <p class="mb-4 text-sm">
                    description
                  </p>

                </div>
              </div>
            </div>
                ';
              }
            } else {
              echo "No results found for ";
            }


            ?>
            <!-- <div class="col-xl-6 col-md-12 mb-xl-0 mb-4 ">
              <div class="card card-blog card-plain">
                <div class="card-header p-0 mt-n4 mx-3">
                  <a class="d-block shadow-xl border-radius-xl">
                    <img src="Images/bruce-mars.jpg" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                  </a>
                </div>
                <div class="card-body p-3">
                   <p class="mb-0 text-sm">category</p> 
                  <a href="javascript:;">
                    <h5>
                      book name
                    </h5>
                  </a>
                  <p class="mb-4 text-sm">
                    description
                  </p>

                </div>
              </div>
            </div> -->

          </div>
        </div>
      </div>
    </div>
    <script>
      $(document).ready(function() {
        var owl = $('.owl-carousel');
        owl.owlCarousel({
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
        })
      })
    </script>
    <?php include "footer.php" ?>

  </div>
  </div>

  <?php include "plugin.php" ?>




  <!--   Core JS Files   -->
  <script src=" assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
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
  <script async defer src="httpitems://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.min.js?v=3.0.4"></script>
</body>
<!-- <select name="faculty" id="faculty" class="form-control">
  <option value="">--select--</option>
  <option value="1">Administration</option>
  <option value="2">Agriculture</option>
  <option value="3">Arts</option>
  <option value="5">Education</option>
  <option value="6">Engineering</option>
  <option value="7">Environmental Design</option>
  <option value="8">Law</option>
  <option value="9">Medicine</option>
  <option value="10">Pharmaceutical Sciences</option>
  <option value="11">Physical Sciences</option>
  <option value="12">Social Sciences</option>
  <option value="13">Veterinary Medicine</option>
  <option value="14">Iya Abubakar Computer Centre</option>
  <option value="15">Institute of Administration</option>
  <option value="16">Institute of Education</option>
  <option value="17">Bursary</option>
  <option value="18">Centre</option>
  <option value="20">Library</option>
  <option value="21">Registry</option>
  <option value="22">Schools</option>
  <option value="23">University Health Services</option>
  <option value="24">VC s Office</option>
  <option value="25">Vet Teaching Hospital</option>
  <option value="26">Centre for Energy Research and Training</option>
  <option value="27">Centre for Biotechnology Research and Training</option>
  <option value="28">Centre for Historical Research and Documentation (Arewa House)</option>
  <option value="29">NAERLS</option>
  <option value="30">NAPRI</option>
  <option value="31">Postgraduate School</option>
  <option value="32">Vice Chancellor's Office</option>
  <option value="33">Institute for Development Research &amp; Training</option>
  <option value="34">Centre for Disaster Risk Management and development Studies</option>
  <option value="35">Iya Abubakar Institute of ICT</option>
  <option value="36">Life Sciences</option>
  <option value="37">Distance Learning Centre</option>
  <option value="40">Business School</option>
  <option value="43">Allied Health Sciences</option>
  <option value="44">Basic Medical Sciences</option>
  <option value="45">Clinical Sciences</option>
  <option value="46">Division of Agricultural College</option>
  <option value="Physical Planning and Municipal Services">Physical Planning and Municipal Services</option>
  <option value="Internal Audit">Internal Audit</option>
</select> -->

</html>