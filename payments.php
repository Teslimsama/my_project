<?php include "session.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "meta.php" ?>
  <title>
    Payments || UniBooks
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
  <link id="pagestyle" href="assets/css/faq.css" rel="stylesheet" />
  <!-- DataTables CSS -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css" />
  <!-- DataTables JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
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
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="index">Home</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Payments</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Payments</h6>
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
      <div class="col-12 mt-5">
        <div class="card vw-70 my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">Lists of Transactions</h6>
            </div>
          </div>
          <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
              <table id="transactions-table" class="table table-striped align-items-center justify-content-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Book</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Amount</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Date</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $student_id = $user['id'];
                  try {
                    $stmt = $conn->prepare("SELECT * FROM payments WHERE customerid=? ORDER BY id DESC");
                    $stmt->execute([$student_id]);
                    $n = 1;
                    while ($payment_rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      $date = $payment_rows['date'];
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
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm"><?php echo $payment_rows['book']; ?></h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-sm font-weight-bold mb-0">₦<?php echo $payment_rows['amount']; ?></p>
                        </td>
                        <td>
                          <h6 class="text-xs font-weight-bold">
                            <?php
                            if ($payment_rows['status'] === 'success') {
                              echo "<span class='badge badge-sm bg-gradient-success'>" . $payment_rows['status'] . "</span></h6>";
                            } else {
                              echo "<span class='badge badge-sm bg-gradient-danger'>" . $payment_rows['status'] . "</span></h6>";
                            }
                            ?>
                        </td>
                        <td class="align-middle text-center">
                          <h6><?php echo $payment_rows['date']; ?></h6>
                        </td>
                        <td class="align-middle">
                          <button class="btn btn-link text-secondary mb-0">
                            <i class="fa fa-ellipsis-v text-xs"></i>
                          </button>
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
  <!-- DataTables Initialization -->
  <script>
    $(document).ready(function() {
      $('#transactions-table').DataTable({
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