<?php include "session.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "meta.php" ?>
  <title>
    Downloads || Unibooks
  </title>
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
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
  <link id="pagestyle" href="assets/css/faq.css" rel="stylesheet" />
  <!-- DataTables CSS -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css" />
  <!-- DataTables JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9952650109664010" crossorigin="anonymous"></script>
</head>

<body class="g-sidenav-show bg-gray-200">
  <?php include 'sidebar.php' ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="index">Home</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Downloads</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Downloads</h6>
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

    <div class="row">
      <div class="col-12">
        <div class="card dets">
          <div class="card-body px-0 pb-2">
            <div class="table-responsive">
              <table id="downloads-table" class="table table-striped align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Your Book's</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                </thead>
                <tbody>
                  <?php
                  $student_id = $user['id'];
                  try {
                    $stmt = $conn->prepare("SELECT * FROM downloads WHERE customerid=? ORDER BY id DESC");
                    $stmt->execute([$student_id]);
                    $n = 1;
                    while ($download_rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      $date = $download_rows['date'];
                  ?>
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <h6><?php echo $n; ?> </h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="avatar-group mt-2">
                            <a href="javascript:;" class="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo $download_rows['book_id']; ?>">
                              <h6><?php echo $download_rows['book_id']; ?></h6>
                            </a>
                          </div>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="text-xs font-weight-bold"><?php echo $date; ?></span>
                        </td>
                      </tr>
                  <?php $n++;
                    }
                  } catch (Exception $e) {
                    echo $e->getMessage();
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include "footer.php" ?>

  </main>
  <?php include "plugin.php" ?>

  <!-- Core JS Files -->
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
  <!-- DataTables Initialization -->
  <script>
    $(document).ready(function() {
      $('#downloads-table').DataTable({
        "stripeClasses": [],
        "order": [
          [0, "asc"]
        ],
        "language": {
          "paginate": {
            "previous": "<span aria-hidden='true'>«</span>",
            "next": "<span aria-hidden='true'>»</span>"
          }
        },
        "pageLength": 10
      });
    });
  </script>
</body>

</html>