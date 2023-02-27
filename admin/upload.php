<?php include "session.php" ?>
<?php
include_once 'database.php';
include 'alert.message.php';

if (isset($_POST['upload'])) {
  $book = $_POST['book'];
  $faculty = $_POST['faculty'];
  // $rand_num = random_int(1000,9999);
  if ($_FILES['book']['error'] === 4) {
    echo
    "<script> alert('does not exist');</script>";
  } else {
    $fileName = $_FILES["book"]["name"];
    $fileSize = $_FILES["book"]["size"];
    $tmpName = $_FILES["book"]["tmp_name"];

    $validExt = ['docx', 'pdf', 'txt'];
    $Ext = explode('.', $fileName);
    $Ext = strtolower(end($Ext));
    if (!in_array($Ext, $validExt)) {
      echo  "<script> alert('invalid file format');</script>";
    } elseif ($fileSize > 1000000) {
      echo
      "<script> alert('the file is too large');</script>";
    } else {
      $newFileName = $title;
      $newFileName .= '.' . $Ext;
      $location = '../pages/unibooks_download/' . $newFileName;
      move_uploaded_file($tmpName, $location);
      echo
      "<script> alert('Successfully Added');
        </script>";
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../Images/apple-touch-icon.png">
  <link rel="shortcut icon" type="image/png" href="../Images/android-chrome-512x512.png">
  <title>
    Upload || Unibooks
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
  <link id="pagestyle" href="../assets/css/faq.css" rel="stylesheet" />
  <!-- <link rel="stylesheet" href="../assets/css/cheatsheet.css"> -->

</head>

<body class="g-sidenav-show  bg-gray-200">
  <?php include "sidebar.php" ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Upload</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Upload</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
              <label class="form-label">Type here...</label>
              <input type="text" style="border: 2px solid grey ;" class="form-control ps-4">
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="./Signin.php" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Sign In</span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

    <div class="card mt-5  w-80 " style="margin: 50px;">
      <div class="card-body form-control ps-4  px-4 pb-2">

        <form method="POST" enctype="multipart/form-data" autocomplete="off">
          <div class="first p-2">
            <label for="">Name of the Book\Material</label>
            <input type="text" style="border: 2px solid grey ;" class="form-control ps-4" name="book" required placeholder="Book\Material">
          </div>
          <div class="last p-2">
            <label for="">Which Faculty Is It For ?</label>
            <input type="text" style="border: 2px solid grey ;" class="form-control ps-4" name="faculty" required placeholder="faculty">
          </div>
          <div class="upload p-2 form-control ps-4">
            <label for="">Upload File </label>
            <input type="file" class="" id="book" name="book">
          </div>
          <div class="butt p-2">
            <button type="submit" class="btn btn-dark text-center" name="upload">Upload book\Material</button>
          </div>
        </form>
      </div>
    </div>

    <div class="card mt-5  w-80 " style="margin: 50px;">
      <div class="card-header">
        <h5>Search input</h5>
      </div>
      <div class="card-body form-control ps-4  px-4 pb-2">
        <div class="msg">
          <?php echo ErrorMessage();
          echo SuccessMessage(); ?>

        </div>
        <form action="app/search.app.php" method="POST">
          <div class="first p-2">
            <label for="">Title</label>
            <input type="text" style="border: 2px solid grey ;" class="form-control ps-4" name="title" required placeholder="Title">
          </div>
          <div class="last p-2">
            <label for="">Description</label>
            <input type="text" style="border: 2px solid grey ;" class="form-control ps-4" name="desc" required placeholder="Description">
          </div>
          <div class="first p-2">
            <label for="">Keywords</label>
            <input type="text" style="border: 2px solid grey ;" class="form-control ps-4" name="keywords" required placeholder="Keywords">
          </div>
          <div class="last p-2">
            <label for="">Link</label>
            <input type="text" style="border: 2px solid grey ;" class="form-control ps-4" name="link" required placeholder="Link">
          </div>

          <div class="butt p-2">
            <button type="submit" class="btn btn-dark text-center" name="search">Submit</button>
          </div>
        </form>
      </div>
    </div>

    <div class="container py-4">
      <div class="container-fluid py-4">
        <!-- footer  -->
        <div class="container-fluid bg- mt-5 ">
          <footer class="py-3 my-4 ">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
              <li class="nav-item"><a href="about_us" class="nav-link px-2 text-light">Home</a></li>
              <li class="nav-item"><a href="#" class="nav-link px-2 text-light">More Website</a></li>
              <li class="nav-item"><a href="donate" class="nav-link px-2 text-light">Donate</a></li>
              <li class="nav-item"><a href="faq" class="nav-link px-2 text-light">FAQs</a></li>
              <li class="nav-item"><a href="about_us" class="nav-link px-2 text-light">About Us</a></li>
            </ul>
            <p class="text-center text-light">&copy;
              <script>
                document.write(new Date().getFullYear())
              </script><a href=""> Testech, Ltd</a>
            </p>

          </footer>
        </div>
        <!-- footer  -->
      </div>
    </div>
  </main>
  <?php include "plugin.php" ?>

  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
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
  <script src="../assets/js/material-dashboard.min.js?v=3.0.4"></script>
</body>

</html>