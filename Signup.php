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
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up || Unibooks, Nigeria</title>
  <link rel="apple-touch-icon" sizes="76x76" href="Images/apple-touch-icon.png">
  <link rel="shortcut icon" type="image/png" href="Images/android-chrome-512x512.png">
  <link id="pagestyle" href="assets/css/material-dashboard.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/app.css">
  <script src="https://kit.fontawesome.com/e9de02addb.js" crossorigin="anonymous"></script>
  <script src="assets/js/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body class="bg-light">
  <?php include "header_app.php"; ?>

  <main class="container py-5">
    <div class="auth-card" style="max-width: 700px;">
      <div class="text-center mb-4">
        <h2 class="fw-bold text-dark">Join Unibooks</h2>
        <p class="text-muted">Access thousands of academic resources</p>
      </div>

      <?php echo ErrorMessage();
      echo SuccessMessage(); ?>

      <form action="signup.app.php" method="POST">
        <!-- Step 1: Personal Information -->
        <div id="step1">
          <h5 class="fw-bold mb-4">Personal Details</h5>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label text-sm fw-bold">First Name</label>
              <input type="text" class="form-control" name="firstname" placeholder="John" required>
            </div>
            <div class="col-md-6">
              <label class="form-label text-sm fw-bold">Last Name</label>
              <input type="text" class="form-control" name="lastname" placeholder="Doe" required>
            </div>

            <div class="col-12">
              <label class="form-label text-sm fw-bold">Username</label>
              <div class="input-group">
                <span class="input-group-text bg-light border-end-0 rounded-start-12" style="border: 2px solid #f1f5f9;">@</span>
                <input type="text" name="username" class="form-control" placeholder="johndoe" required>
              </div>
            </div>

            <div class="col-12">
              <label class="form-label text-sm fw-bold">Email Address</label>
              <input type="email" class="form-control" name="email" placeholder="john@university.edu" required>
            </div>

            <div class="col-md-6">
              <label class="form-label text-sm fw-bold">Phone Number</label>
              <input type="tel" class="form-control" name="phone" placeholder="08012345678" required>
            </div>

            <div class="col-md-6">
              <label class="form-label text-sm fw-bold">Date of Birth</label>
              <input type="date" class="form-control" name="dob" required>
            </div>

            <div class="col-md-6">
              <label class="form-label text-sm fw-bold">Gender</label>
              <select class="form-select" name="gender" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>

            <div class="col-12 mt-4">
              <button type="button" class="btn btn-primary w-100 py-3 rounded-pill shadow-primary fw-bold" onclick="nextStep()">Next: Academic Details</button>
            </div>
          </div>
        </div>

        <!-- Step 2: Academic & Security -->
        <div id="step2" style="display: none;">
          <h5 class="fw-bold mb-4">Academic & Security</h5>
          <div class="row g-3">
            <div class="col-md-12">
              <label class="form-label text-sm fw-bold">Current Level</label>
              <select class="form-select" name="levell" required>
                <option value="">Select Level</option>
                <option value="100">100L</option>
                <option value="200">200L</option>
                <option value="300">300L</option>
                <option value="400">400L</option>
                <option value="500">500L</option>
              </select>
            </div>

            <div class="col-12">
              <div class="mb-3">
                <select class="select2 typeahead form-select w-100" name="university" data-typeahead-source='<?php echo json_encode($universities); ?>' required>
                  <option value="">Select University</option>
                  <?php foreach ($universities as $university): ?>
                    <option value="<?php echo htmlspecialchars($university); ?>"><?php echo htmlspecialchars($university); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3">
                <select class="select2 typeahead form-select w-100" name="faculty" data-typeahead-source='<?php echo json_encode($faculties); ?>' required>
                  <option value="">Select Faculty</option>
                  <?php foreach ($faculties as $faculty): ?>
                    <option value="<?php echo htmlspecialchars($faculty); ?>"><?php echo htmlspecialchars($faculty); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3">
                <select class="select2 typeahead form-select w-100" name="department" data-typeahead-source='<?php echo json_encode($departments); ?>' required>
                  <option value="">Select Department</option>
                  <?php foreach ($departments as $department): ?>
                    <option value="<?php echo htmlspecialchars($department); ?>"><?php echo htmlspecialchars($department); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3">
                <select class="select2 typeahead form-select w-100" name="course" data-typeahead-source='<?php echo json_encode($courses); ?>' required>
                  <option value="">Select Course</option>
                  <?php foreach ($courses as $course): ?>
                    <option value="<?php echo htmlspecialchars($course); ?>"><?php echo htmlspecialchars($course); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="col-12">
              <h6 class="fw-bold mb-3">Security</h6>
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label text-sm fw-bold">Password</label>
                  <input type="password" class="form-control" name="password" placeholder="••••••••" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label text-sm fw-bold">Confirm Password</label>
                  <input type="password" class="form-control" name="repassword" placeholder="••••••••" required>
                </div>
              </div>
            </div>

            <div class="col-12">
              <label class="form-label text-sm fw-bold">How did you hear about us?</label>
              <input type="text" class="form-control" name="refer" placeholder="Social Media, Friend, etc.">
            </div>

            <div class="col-12 mt-4 d-flex gap-2">
              <button type="button" class="btn btn-light flex-fill py-3 rounded-pill fw-bold" onclick="prevStep()">Back</button>
              <button class="btn btn-primary flex-fill py-3 rounded-pill shadow-primary fw-bold" name="submit" type="submit">Complete Registration</button>
            </div>

            <div class="col-12 text-center">
              <p class="text-xs text-muted">
                By continuing, you agree to our <a href="terms_and_conditions" class="text-primary text-decoration-none fw-bold">Terms</a> and
                <a href="privacy_policy" class="text-primary text-decoration-none fw-bold">Privacy Policy</a>.
              </p>
            </div>
          </div>
        </div>
      </form>
    </div>

    <?php include "footer.php"; ?>
  </main>

  <?php include "bottom_nav_app.php"; ?>

  <style>
    .rounded-start-12 {
      border-top-left-radius: 12px !important;
      border-bottom-left-radius: 12px !important;
    }

    /* Fix Select2 Width */
    .select2-container {
      width: 100% !important;
      display: block;
    }

    /* Style the main selection box to match form-control */
    .select2-container--default .select2-selection--single {
      background-color: #f8fafc;
      border: 1px solid #ced4da;
      /* standard bootstrap border color or match theme */
      border-radius: 12px;
      height: 48px;
      /* Match form-control height */
      display: flex;
      align-items: center;
      padding: 0 12px;
      transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    /* Focus state */
    .select2-container--default.select2-container--focus .select2-selection--single {
      border-color: #86b7fe;
      box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    /* Arrow/Chevron alignment */
    .select2-container--default .select2-selection--single .select2-selection__arrow {
      height: 46px;
      top: 1px;
      right: 10px;
    }

    /* Render rendered text formatting */
    .select2-container--default .select2-selection--single .select2-selection__rendered {
      line-height: 46px;
      color: #344767;
      /* Match text color */
      padding-left: 0;
    }

    /* If search field exists inside dropdown */
    .select2-search--dropdown .select2-search__field {
      border-radius: 8px;
    }
  </style>

  <script src="https://kit.fontawesome.com/3252b22438.js" crossorigin="anonymous"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.select2').select2({
        tags: true, // Allow user to enter custom values
        tokenSeparators: [',', ' '], // Define how to separate tags
      });

      $('select.typeahead').each(function() {
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

    function nextStep() {
      // Simple client-side validation for step 1
      var step1Inputs = document.querySelectorAll('#step1 input[required], #step1 select[required]');
      var isValid = true;

      step1Inputs.forEach(function(input) {
        if (!input.checkValidity()) {
          isValid = false;
          input.reportValidity();
        }
      });

      if (isValid) {
        document.getElementById('step1').style.display = 'none';
        document.getElementById('step2').style.display = 'block';
      }
    }

    function prevStep() {
      document.getElementById('step2').style.display = 'none';
      document.getElementById('step1').style.display = 'block';
    }
  </script>
</body>

</html>