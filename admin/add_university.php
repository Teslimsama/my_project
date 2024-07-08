<?php
include 'session.php';

// Function to fetch data from the database
function fetchData($conn, $columnName)
{
  $data = array();
  $sql = "SELECT DISTINCT $columnName FROM university_faculty_department";
  $stmt = $conn->query($sql);

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row[$columnName];
  }

  return $data;
}

// Fetch data for each dropdown
$universities = fetchData($conn, 'University');
$faculties = fetchData($conn, 'Faculty');
$departments = fetchData($conn, 'Department');
$courses = fetchData($conn, 'Course');
?>
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="assets/images/favicon.png" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
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
          <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="msg">
                  <?php echo ErrorMessage();
                  echo SuccessMessage(); ?>
                </div>
                <h4 class="card-title">University Faculty Department Form</h4>
                <p class="card-description"> Add new university, faculty, department, and course </p>
                <form class="forms-sample" method="post" action="school_input.php">
                  <div class="form-group">
                    <label for="university">University</label>
                    <select class="form-control select2" id="university" name="university" placeholder="University" data-typeahead-source='<?php echo json_encode($universities); ?>' required>
                      <option value="">Select University</option>
                      <?php foreach ($universities as $university) {
                        echo "<option value='$university'>$university</option>";
                      } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="faculty">Faculty</label>
                    <select class="form-control select2" id="faculty" name="faculty" placeholder="Faculty" data-typeahead-source='<?php echo json_encode($faculties); ?>' required>
                      <option value="">Select Faculty</option>
                      <?php foreach ($faculties as $faculty) {
                        echo "<option value='$faculty'>$faculty</option>";
                      } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="department">Department</label>
                    <select class="form-control select2" id="department" name="department" placeholder="Department" data-typeahead-source='<?php echo json_encode($departments); ?>' required>
                      <option value="">Select Department</option>
                      <?php foreach ($departments as $department) {
                        echo "<option value='$department'>$department</option>";
                      } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="course">Course</label>
                    <select class="form-control select2" id="course" name="course" placeholder="Course" data-typeahead-source='<?php echo json_encode($courses); ?>' required>
                      <option value="">Select Course</option>
                      <?php foreach ($courses as $course) {
                        echo "<option value='$course'>$course</option>";
                      } ?>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary me-2">Submit</button>
                  <button type="reset" class="btn btn-light">Cancel</button>
                </form>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <?php include 'footer.php'; ?>
          <!-- partial -->
        </div>
      </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script>
      $(document).ready(function() {
        $('.select2').select2({
          tags: true, // Allow user to enter custom values
          tokenSeparators: [',', ' '], // Define how to separate tags
          data: function() {
            var element = $(this);
            return {
              id: element.val(),
              text: element.val()
            };
          }
        });

        $('select[data-typeahead-source]').each(function() {
          var $this = $(this);
          var source = $this.data('typeahead-source');
          $this.select2({
            tags: true,
            tokenSeparators: [',', ' '],
            data: source.map(function(item) {
              return {
                id: item,
                text: item
              };
            })
          });
        });
      });
    </script>
    <!-- End custom js for this page -->
</body>

</html>