<?php
include "session.php";

// Redirect to login if not authenticated
if (!isset($_SESSION['user'])) {
  header('location: Signin');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "meta.php" ?>
  <title>My Books || Unibooks</title>
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
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" />
</head>

<body class="bg-light">
  <?php include "header_app.php"; ?>

  <main class="container py-5">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="mb-4 d-flex justify-content-between align-items-center">
          <div>
            <h3 class="fw-bold mb-2"><i class="fa fa-book me-2 text-primary"></i>My Books</h3>
            <p class="text-muted mb-0">Manage your uploaded books and projects</p>
          </div>
          <a href="books_add" class="btn btn-primary rounded-pill px-4">
            <i class="fa fa-plus me-2"></i>Add Book
          </a>
        </div>

        <div class="card border-0 shadow-sm">
          <div class="card-body p-4">
            <div class="msg">
              <?php echo ErrorMessage();
              echo SuccessMessage(); ?>
            </div>

            <div class="table-responsive">
              <table class="table table-hover align-items-center mb-0" id="striped_data">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">#</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Image</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Book</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Price</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Type</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">University</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Faculty</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Department</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Level</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Action</th>
                  </tr>
                </thead>
                <tbody>
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

  <!-- DataTables -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      var dataTable = $('#striped_data').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
          url: "fetch.php",
          type: "POST"
        },
        "columnDefs": [{
          "targets": [0, 3, 4],
          "orderable": false,
        }],
        "language": {
          "paginate": {
            "previous": "<span aria-hidden='true'>«</span>",
            "next": "<span aria-hidden='true'>»</span>"
          }
        }
      });

      $(document).on('click', '.delete', function() {
        var product_id = $(this).attr("id");
        if (confirm("Are you sure you want to delete this book?")) {
          $.ajax({
            url: "delete.php",
            method: "POST",
            data: {
              product_id: product_id
            },
            success: function(data) {
              alert(data);
              dataTable.ajax.reload();
            }
          });
        } else {
          return false;
        }
      });
    });
  </script>
</body>

</html>