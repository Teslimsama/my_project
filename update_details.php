<?php
include "session.php";

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
  <?php include "meta.php"; ?>
  <title>Update Profile || Unibooks</title>
  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/e9de02addb.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/app.css">
  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="assets/js/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <style>
    .select2-container {
      width: 100% !important;
    }

    .select2-container--default .select2-selection--single {
      background-color: #f8fafc;
      border: 1px solid #d1d5db;
      border-radius: 12px;
      height: 48px;
      display: flex;
      align-items: center;
      padding: 0 12px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
      line-height: 48px;
      padding-left: 0;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
      height: 46px;
    }
  </style>
</head>

<body class="bg-light">
  <?php include "header_app.php"; ?>

  <main class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-10 col-xl-9">
        <div class="card border-0 shadow-sm">
          <div class="card-body p-4 p-md-5">
            <div class="mb-4">
              <h3 class="fw-bold mb-2"><i class="fa fa-user-edit me-2 text-primary"></i>Update Your Details</h3>
              <p class="text-muted mb-0">Keep your profile information up to date</p>
            </div>

            <div class="msg mb-3">
              <?php echo ErrorMessage();
              echo SuccessMessage(); ?>
            </div>

            <form method="POST" enctype="multipart/form-data" action="update.app.php" autocomplete="off">
              <!-- Personal Info Section -->
              <div class="mb-4">
                <h6 class="fw-bold text-dark mb-3"><i class="fa fa-id-card me-2 text-primary"></i>Personal Information</h6>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label text-sm fw-bold">Firstname</label>
                    <input type="text" class="form-control" name="firstname" value="<?php echo $user['firstname']; ?>" placeholder="First name" required />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label text-sm fw-bold">Lastname</label>
                    <input type="text" class="form-control" name="lastname" value="<?php echo $user['lastname']; ?>" placeholder="Last name" required />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label text-sm fw-bold">Email</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>" placeholder="Email" required />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label text-sm fw-bold">Username</label>
                    <input type="text" class="form-control" name="username" value="<?php echo $user['username']; ?>" placeholder="Username" required />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label text-sm fw-bold">New Password <span class="text-muted">(leave blank to keep current)</span></label>
                    <input type="password" class="form-control" name="password" placeholder="Enter new password" />
                    <input type="hidden" name="curr_password" value="<?php echo $user['password']; ?>" />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label text-sm fw-bold">Phone Number</label>
                    <input type="tel" class="form-control" name="phone" value="<?php echo $user['phone']; ?>" placeholder="e.g. 0801223347" required />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label text-sm fw-bold">Profile Picture</label>
                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label text-sm fw-bold">Level</label>
                    <select class="form-select select2" name="level">
                      <option value="">Select Level</option>
                      <option value="100" <?php echo ($user['level'] == '100') ? 'selected' : ''; ?>>100L</option>
                      <option value="200" <?php echo ($user['level'] == '200') ? 'selected' : ''; ?>>200L</option>
                      <option value="300" <?php echo ($user['level'] == '300') ? 'selected' : ''; ?>>300L</option>
                      <option value="400" <?php echo ($user['level'] == '400') ? 'selected' : ''; ?>>400L</option>
                      <option value="500" <?php echo ($user['level'] == '500') ? 'selected' : ''; ?>>500L</option>
                    </select>
                  </div>
                </div>
              </div>

              <!-- Academic Info Section -->
              <div class="mb-4">
                <h6 class="fw-bold text-dark mb-3"><i class="fa fa-graduation-cap me-2 text-primary"></i>Academic Information</h6>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label text-sm fw-bold">University</label>
                    <select class="form-select select2" name="university">
                      <option value="">Select University</option>
                      <?php foreach ($universities as $university) : ?>
                        <option value="<?php echo $university; ?>" <?php echo ($user['school'] == $university) ? 'selected' : ''; ?>><?php echo htmlspecialchars($university); ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label text-sm fw-bold">Faculty</label>
                    <!-- User Faculty: <?php echo $user['faculty']; ?> -->
                    <select class="form-select select2" name="faculty">
                      <option value="">Select Faculty</option>
                      <?php foreach ($faculties as $faculty) : ?>
                        <option value="<?php echo $faculty; ?>" <?php echo (strcasecmp($user['faculty'], $faculty) == 0) ? 'selected' : ''; ?>><?php echo htmlspecialchars($faculty); ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label text-sm fw-bold">Department</label>
                    <!-- User Department: <?php echo $user['department']; ?> -->
                    <select class="form-select select2" name="department">
                      <option value="">Select Department</option>
                      <?php foreach ($departments as $department) : ?>
                        <option value="<?php echo $department; ?>" <?php echo (strcasecmp($user['department'], $department) == 0) ? 'selected' : ''; ?>><?php echo htmlspecialchars($department); ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label text-sm fw-bold">Course</label>
                    <!-- User Course: <?php echo $user['course']; ?> -->
                    <select class="form-select select2" name="course">
                      <option value="">Select Course</option>
                      <?php foreach ($courses as $course) : ?>
                        <option value="<?php echo $course; ?>" <?php echo (strcasecmp($user['course'], $course) == 0) ? 'selected' : ''; ?>><?php echo htmlspecialchars($course); ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <!-- Action Buttons -->
              <div class="d-flex gap-3 mt-4">
                <button type="submit" name="submit" class="btn btn-primary rounded-pill px-5 shadow-primary">
                  <i class="fa fa-save me-2"></i>Update Profile
                </button>
                <a class="btn btn-light rounded-pill px-4" href="profilepage">
                  <i class="fa fa-times me-2"></i>Cancel
                </a>
              </div>
            </form>
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
  <script>
    $(document).ready(function() {
      $('.select2').select2({
        tags: true,
        tokenSeparators: [',', ' ']
      });

      // Trigger change to ensure selected values are displayed
      $('.select2').trigger('change');
    });
  </script>
</body>

</html>