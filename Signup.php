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
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/signup.css">
  <link rel="stylesheet" href="assets/css/material-dashboard.css">
  <script src="https://kit.fontawesome.com/e9de02addb.js" crossorigin="anonymous"></script>
  <script src="assets/js/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
  <div class="container z-index-sticky top-0 mb-5">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur border-radius-xl top-0 z-index-3 bg-dark shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid ps-2 pe-0">
            <a href="index"><img class="me-3" src="Images/unibooks copy.png" alt="" width="50"></a>
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3" href="index" target="_blank">
              <h4>Unibooks</h4>
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                  <a class="nav-link title d-flex align-items-center me-2 active" aria-current="page" href="index">
                    <i class="fa-solid fa-house text-dark me-1"></i>
                    Home
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link title d-flex align-items-center me-2 active" aria-current="page" href="./about_us">
                    <i class="fa-solid fa-users text-dark me-1"></i>
                    About Us
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2 title" href="./Signin">
                    <i class="fa-solid fa-arrow-right-to-bracket opacity-6 text-dark me-1"></i>
                    Login
                  </a>
                </li>
              </ul>
            </div>
          </div>
      </div>
    </div>
  </div>
  </nav>
  <!-- End Navbar -->

  <div class="container form-control px-2">
    <div class="card mt-5 bg-light">
      <div class="card-body">
        <div class="text-center">
          <h3>Create a Unibooks Account</h3>
        </div>
        <?php echo ErrorMessage();
        echo SuccessMessage(); ?>

        <form action="signup.app.php" method="POST">
          <div class="row">
            <div class="first col-6">
              <label for="">Firstname</label>
              <input style="border: 2px solid grey;" type="text" class="form-control ps-4" name="firstname" placeholder="First name">
            </div>
            <div class="last col-6">
              <label for="">Lastname</label>
              <input style="border: 2px solid grey;" type="text" class="form-control ps-4" name="lastname" placeholder="Last name">
            </div>
          </div>

          <div class="user">
            <label>Username</label>
            <input style="border: 2px solid grey;" type="text" name="username" placeholder="Username" class="form-control ps-4">
            <span class="invalid-feedback"><?php echo $username_err; ?></span>
          </div>

          <div class="email">
            <label for="">Email</label>
            <input style="border: 2px solid grey;" type="email" class="form-control ps-4" name="email" placeholder="Enter Valid email" required>
          </div>

          <div class="row">
            <div class="phone col-6">
              <label for="">Phone No</label>
              <input style="border: 2px solid grey;" type="tel" class="form-control ps-4" name="phone" placeholder="Phone e.g., 080874456644" required>
            </div>
            <div class="level col-6">
              <label for="">Level</label>
              <select class="form-select form-select-md" name="levell" aria-label=".form-select-mg example">
                <option>Current Level</option>
                <option value="100">100L</option>
                <option value="200">200L</option>
                <option value="300">300L</option>
                <option value="400">400L</option>
                <option value="500">500L</option>
              </select>
            </div>
          </div>

          <div class="School mt-3">
            <select class="select2 typeahead form-select form-select-md" name="university" style="width: 100%;" data-typeahead-source='<?php echo json_encode($universities); ?>'>
              <option value="">Select University</option>
              <?php foreach ($universities as $university) {
                echo "<option value='$university'>$university</option>";
              } ?>
            </select>
          </div>

          <div class="mt-3">
            <select class="select2 typeahead form-select form-select-md" name="faculty" style="width: 100%;" data-typeahead-source='<?php echo json_encode($faculties); ?>'>
              <option value="">Select Faculty</option>
              <?php foreach ($faculties as $faculty) {
                echo "<option value='$faculty'>$faculty</option>";
              } ?>
            </select>
          </div>

          <div class="mt-3">
            <select class="select2 typeahead form-select form-select-md" name="department" style="width: 100%;" data-typeahead-source='<?php echo json_encode($departments); ?>'>
              <option value="">Select Department</option>
              <?php foreach ($departments as $department) {
                echo "<option value='$department'>$department</option>";
              } ?>
            </select>
          </div>

          <div class="mt-3">
            <select class="select2 typeahead form-select form-select-md" name="course" style="width: 100%;" data-typeahead-source='<?php echo json_encode($courses); ?>'>
              <option value="">Select Course</option>
              <?php foreach ($courses as $course) {
                echo "<option value='$course'>$course</option>";
              } ?>
            </select>
          </div>

          <div class="gender mt-4">Gender
            <div class="form-check">
              <input class="form-check-input" type="radio" name="gender" value="male" id="gender">
              <label class="form-check-label" for="flexRadioDefault1">
                Male
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="gender" value="female" id="gender" checked>
              <label class="form-check-label" for="flexRadioDefault2">
                Female
              </label>
            </div>
          </div>

          <div class="password">
            <label class="mt-3" for="">Create Password</label>
            <input style="border: 2px solid grey;" type="password" class="form-control ps-4" name="password" placeholder="Create a password" required>
          </div>
          <div class="confirm">
            <label for="">Confirm Your Password</label>
            <input style="border: 2px solid grey;" type="password" class="form-control ps-4" name="repassword" placeholder="Confirm password" required>
          </div>
          <div class="row">
            <div class="col-6">
              <label for="">Date of birth</label>
              <input style="border: 2px solid grey;" type="date" class="form-control ps-4" name="dob" required>
            </div>
            <div class="referral col-6">
              <label for=""></label>
              <input style="border: 2px solid grey;" type="text" class="form-control ps-4" name="refer" placeholder="How did you hear about us?" required>
            </div>
          </div>
          <div class="mt-5">
            <button class="btn btn-dark w-100" name="submit" type="submit">Sign Up</button>
          </div>
          <small class="text-center">By continuing you confirm that you agree to the terms of use and confirm that you have read the <a href="#">privacy policy</a></small>
        </form>
      </div>
    </div>
  </div>

  <!-- footer -->
  <?php include "footer.php" ?>
  <!-- footer -->

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
  </script>
</body>

</html>