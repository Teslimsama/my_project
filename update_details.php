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
  <title>Profile page || Unibooks</title>
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
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet">
  <!-- <link href="assets/css/profile.css" rel="stylesheet"> -->
  <script src="assets/js/jquery.min.js"></script>
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9952650109664010" crossorigin="anonymous"></script>
  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Update Details</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Update Details</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <form action="search" method="GET">
              <div class="input-group input-group-outline">
                <label class="col-sm-3 col-form-label" class="form-label">Type here...</label>
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
        <div class="content-wrapper">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <div class="msg">
                  <?php echo ErrorMessage();
                  echo SuccessMessage(); ?>
                </div>
                <h4 class="card-title">Update Your Details</h4>
                <form method="POST" enctype="multipart/form-data" action="update.app.php" autocomplete="off">
                  <p class="card-description">Personal Info</p>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="input-group input-group-outline row">
                        <label class="col-sm-3 col-form-label">Firstname</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="firstname" value="<?php echo $user['firstname']; ?>" placeholder="First name" required />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group input-group-outline row">
                        <label class="col-sm-3 col-form-label">Lastname</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="lastname" value="<?php echo $user['lastname']; ?>" placeholder="Last name" required />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="input-group input-group-outline row">
                        <label class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>" placeholder="Email" required />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group input-group-outline row">
                        <label class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="username" value="<?php echo $user['username']; ?>" placeholder="Username" required />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="input-group input-group-outline row">
                        <label class="col-sm-3 col-form-label">New Password</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" name="password" />
                          <input type="hidden" class="form-control" name="curr_password" value="<?php echo $user['password']; ?>" required />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group input-group-outline row">
                        <label class="col-sm-3 col-form-label">Phone number</label>
                        <div class="col-sm-9">
                          <input type="tel" class="form-control" name="phone" value="<?php echo $user['phone']; ?>" placeholder="Phone eg. 0801223347" required />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="input-group input-group-outline row">
                        <label class="col-sm-3 col-form-label">Upload Image</label>
                        <div class="col-sm-9">
                          <input type="file" class="form-control" id="photo" name="photo">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group input-group-outline row">
                        <label class="col-sm-3 col-form-label">Level</label>
                        <div class="col-sm-9">
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
                  </div>
                  <p class="card-description">Academic Info</p>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="input-group input-group-outline row">
                        <label class="col-sm-3 col-form-label">University</label>
                        <div class="col-sm-9">
                          <select class="form-select select2" name="university" data-typeahead-source='<?php echo json_encode($universities); ?>'>
                            <option value="">Select University</option>
                            <?php foreach ($universities as $university) : ?>
                              <option value="<?php echo $university; ?>" <?php echo ($user['school'] == $university) ? 'selected' : ''; ?>><?php echo htmlspecialchars($university); ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group input-group-outline row">
                        <label class="col-sm-3 col-form-label">Faculty</label>
                        <div class="col-sm-9">
                          <select class="form-select select2" name="faculty" data-typeahead-source='<?php echo json_encode($faculties); ?>'>
                            <option value="">Select Faculty</option>
                            <?php foreach ($faculties as $faculty) : ?>
                              <option value="<?php echo $faculty; ?>" <?php echo ($user['faculty'] == $faculty) ? 'selected' : ''; ?>><?php echo htmlspecialchars($faculty); ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <div class="input-group input-group-outline row">
                        <label class="col-sm-3 col-form-label">Department</label>
                        <div class="col-sm-9">
                          <select class="form-select select2" name="department" data-typeahead-source='<?php echo json_encode($departments); ?>'>
                            <option value="">Select Department</option>
                            <?php foreach ($departments as $department) : ?>
                              <option value="<?php echo $department; ?>" <?php echo ($user['department'] == $department) ? 'selected' : ''; ?>><?php echo htmlspecialchars($department); ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group input-group-outline row">
                        <label class="col-sm-3 col-form-label">Course</label>
                        <div class="col-sm-9">
                          <select class="form-select select2" name="course" data-typeahead-source='<?php echo json_encode($courses); ?>'>
                            <option value="">Select Course</option>
                            <?php foreach ($courses as $course) : ?>
                              <option value="<?php echo $course; ?>" <?php echo ($user['course'] == $course) ? 'selected' : ''; ?>><?php echo htmlspecialchars($course); ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <button type="submit" name="submit" class="btn btn-primary me-2">Update</button>
                  <button type="reset" class="btn btn-light">Cancel</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    </div>

    <?php include "footer.php" ?>

    <!-- footer  -->
    </div>
    </div>
  </main>
  <script>
    $(document).ready(function() {
      $('.select2').select2({
        tags: true, // Allow user to enter custom values
        tokenSeparators: [',', ' '] // Define how to separate tags
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