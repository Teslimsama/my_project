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
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="assets/images/favicon.png" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.css" />
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
          <div class="col-12 grid-margin">
            <div class="card mt-5 ">
              <div class="card-body">
                <div class="msg">
                  <?php echo ErrorMessage();
                  echo SuccessMessage(); ?>
                </div>
                <h3 class="text-center">Create a Unibooks Account</h3>

                <form class="form-sample" action="signup.app.php" method="POST">
                  <p class="card-description">Personal info</p>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">First Name</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="firstname" placeholder="First name" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Last Name</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="lastname" placeholder="Last name" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" name="username" placeholder="Username" required>
                          <span class="invalid-feedback"><?php echo $username_err; ?></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control" name="email" placeholder="Valid email" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Phone Number</label>
                        <div class="col-sm-9">
                          <input type="tel" class="form-control" name="phone" placeholder="Phone eg.080874456644" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Level</label>
                        <div class="col-sm-9">
                          <select class="form-select form-select-md" name="levell" required>
                            <option value="" disabled selected>Current Level</option>
                            <option value="100">100L</option>
                            <option value="200">200L</option>
                            <option value="300">300L</option>
                            <option value="400">400L</option>
                            <option value="500">500L</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">University</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control typeahead" name="university" placeholder="Select or type University" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Faculty</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control typeahead" name="faculty" placeholder="Select or type Faculty" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Department</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control typeahead" name="department" placeholder="Select or type Department" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Course</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control typeahead" name="course" placeholder="Select or type Course" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Gender</label>
                        <div class="col-sm-9">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="male" id="genderMale">
                            <label class="form-check-label" for="genderMale">Male</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="female" id="genderFemale" checked>
                            <label class="form-check-label" for="genderFemale">Female</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Date of Birth</label>
                        <div class="col-sm-9">
                          <input type="date" class="form-control" name="dob" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" name="password" placeholder="Create a password" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Confirm Password</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" name="repassword" placeholder="Confirm password" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>How did you hear about us?</label>
                    <input type="text" class="form-control" name="refer" placeholder="Referral Source" required>
                  </div>
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" required>
                      <label class="form-check-label">I agree to the terms and conditions</label>
                    </div>
                  </div>
                  <button type="submit" name="submit" class="btn btn-primary btn-block">Sign Up</button>
                  <small class="form-text text-center">By continuing you confirm that you agree to the terms of use and confirm that you have read the <a href="#">privacy policy</a>.</small>
                </form>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <script>
      $(document).ready(function() {
        var universities = <?php echo json_encode($universities); ?>;
        var faculties = <?php echo json_encode($faculties); ?>;
        var departments = <?php echo json_encode($departments); ?>;
        var courses = <?php echo json_encode($courses); ?>;

        $('.typeahead').typeahead({
          source: function(query, process) {
            if ($(this)[0].$element.attr('name') === 'university') {
              return process(universities);
            } else if ($(this)[0].$element.attr('name') === 'faculty') {
              return process(faculties);
            } else if ($(this)[0].$element.attr('name') === 'department') {
              return process(departments);
            } else if ($(this)[0].$element.attr('name') === 'course') {
              return process(courses);
            }
          },
          showHintOnFocus: true,
          autoSelect: false,
          fitToElement: true,
          afterSelect: function(item) {
            $(this)[0].$element.val(item);
          },
          addNew: function(item) {
            return {
              id: item,
              name: item
            };
          }
        });
      });
    </script>
    <!-- End custom js for this page-->
</body>

</html>