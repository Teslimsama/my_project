<?php include "session.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Unibooks Nigeria</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="assets/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php include 'navbar.php'; ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      <?php include 'sidebar.php'; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="msg">
                  <?php echo ErrorMessage();
                  echo SuccessMessage(); ?>
                </div>
                <h4 class="card-title">Users</h4>
                <div class="table-responsive">
                  <table id="striped_data" class="table table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>University</th>
                        <th>Faculty</th>
                        <th>Department</th>
                        <th>Course</th>
                        <th>Level</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      try {
                        // Fetch users for a specific student
                        $stmt = $conn->prepare("SELECT * FROM unibooker ORDER BY id DESC");
                        $stmt->execute();

                        // Initialize a counter for row numbering
                        $rowNumber = 1;

                        // Loop through each row in the result set
                        while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
                          // Fetch the date and format it if needed
                          $date = $user['date'];
                      ?>
                          <tr>
                            <td>
                              <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                  <h6><?php echo $rowNumber; ?></h6>
                                </div>
                              </div>
                            </td>
                            <td>
                              <div class="d-flex px-2">
                                <div class="my-auto">
                                  <h6 class="mb-0 text-sm"><?php echo htmlspecialchars($user['firstname'] . " " . $user['lastname']); ?></h6>
                                </div>
                              </div>
                            </td>
                            <td>
                              <h6 class="mb-0 text-sm"><?php echo $user['email']; ?></h6>
                            </td>
                            <td>
                              <h6 class="text-xs font-weight-bold">
                                <?php echo htmlspecialchars($user['phone']); ?>
                              </h6>
                            </td>
                            <td class="align-middle text-center">
                              <h6><?php echo htmlspecialchars($user['school']); ?></h6>
                            </td>
                            <td class="align-middle text-center">
                              <h6><?php echo htmlspecialchars($user['faculty']); ?></h6>
                            </td>
                            <td class="align-middle text-center">
                              <h6><?php echo htmlspecialchars($user['department']); ?></h6>
                            </td>
                            <td class="align-middle text-center">
                              <h6><?php echo htmlspecialchars($user['course']); ?></h6>
                            </td>
                            <td class="align-middle text-center">
                              <h6><?php echo htmlspecialchars($user['level']); ?></h6>
                            </td>
                            <td class="align-middle">
                              <button class="btn btn-link text-secondary mb-0">
                                <i class="fa fa-ellipsis-v text-xs"></i>
                              </button>
                            </td>
                          </tr>
                      <?php
                          $rowNumber++;
                        }
                      } catch (PDOException $e) {
                        // Handle database-related errors
                        echo "<div class='alert alert-danger'>Error fetching user data: " . htmlspecialchars($e->getMessage()) . "</div>";
                      } catch (Exception $e) {
                        // Handle general errors
                        echo "<div class='alert alert-danger'>An unexpected error occurred: " . htmlspecialchars($e->getMessage()) . "</div>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <?php include 'footer.php'; ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/template.js"></script>
  <script src="assets/js/settings.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script>
    $(document).ready(function() {
      $('#striped_data').DataTable();
    });
  </script>
  <!-- End custom js for this page-->
</body>

</html>