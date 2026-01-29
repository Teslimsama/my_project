<?php include "session.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "meta.php" ?>
  <title>Payments || Unibooks</title>
  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/e9de02addb.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/app.css">
  <!-- DataTables CSS -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css" />
  <!-- DataTables JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
</head>

<body class="bg-light">
  <?php include "header_app.php"; ?>

  <main class="container py-5">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="mb-4">
          <h3 class="fw-bold mb-2"><i class="fa fa-receipt me-2 text-primary"></i>Payment History</h3>
          <p class="text-muted mb-0">View all your book purchase transactions</p>
        </div>

        <div class="card border-0 shadow-sm">
          <div class="card-body p-4">
            <div class="table-responsive">
              <table id="transactions-table" class="table table-hover align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">#</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Book</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Amount</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Status</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Date</th>
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
                              <h6 class="mb-0 text-sm"><?php echo $n; ?></h6>
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
                          <p class="text-sm font-weight-bold mb-0">₦<?php echo number_format($payment_rows['amount'], 2); ?></p>
                        </td>
                        <td>
                          <?php
                          if ($payment_rows['status'] === 'success') {
                            echo "<span class='badge bg-success'>Success</span>";
                          } else {
                            echo "<span class='badge bg-danger'>" . ucfirst($payment_rows['status']) . "</span>";
                          }
                          ?>
                        </td>
                        <td>
                          <span class="text-sm"><?php echo date('M d, Y', strtotime($payment_rows['date'])); ?></span>
                        </td>
                      </tr>
                  <?php
                      $n++;
                    }
                  } catch (Exception $e) {
                    echo "<tr><td colspan='5' class='text-center text-danger'>Error: " . $e->getMessage() . "</td></tr>";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include "footer.php" ?>
  </main>

  <?php include "bottom_nav_app.php"; ?>
  <?php include "plugin.php" ?>

  <!-- Core JS Files -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/material-dashboard.min.js?v=3.0.4"></script>

  <!-- DataTables Initialization -->
  <script>
    $(document).ready(function() {
      $('#transactions-table').DataTable({
        "stripeClasses": [],
        "order": [
          [0, "desc"]
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