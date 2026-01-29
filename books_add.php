<?php include "session.php";
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
  <?php include "meta.php" ?>
  <title>Add Books || Unibooks</title>
  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/e9de02addb.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/app.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
</head>

<body class="bg-light">
  <?php include "header_app.php"; ?>

  <main class="container py-5">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-10">
        <div class="mb-4">
          <h3 class="fw-bold mb-2"><i class="fa fa-upload me-2 text-primary"></i>Upload Book</h3>
          <p class="text-muted mb-0">Share your books and projects with other students</p>
        </div>

        <div class="card border-0 shadow-sm">
          <div class="card-body p-4">
            <div class="msg">
              <?php echo ErrorMessage();
              echo SuccessMessage(); ?>
            </div>

            <form method="POST" enctype="multipart/form-data" action="search.app.php" autocomplete="off">
              <!-- Book Info Section -->
              <div class="mb-4">
                <h6 class="fw-bold text-primary mb-3"><i class="fa fa-book me-2"></i>Book Information</h6>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="title" placeholder="Enter book title" required />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Type <span class="text-danger">*</span></label>
                    <select class="form-select" id="option-select-type" name="type">
                      <option value="Books">Books</option>
                      <option value="Projects">Projects</option>
                    </select>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Description <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="desc" rows="3" placeholder="Brief description of the book" required></textarea>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Keywords <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="keywords" placeholder="e.g., Chemistry, Organic, Lab" required />
                  </div>
                  <div class="col-md-6" id="amount-input-container" style="display: none;">
                    <label class="form-label">Amount (₦)</label>
                    <input type="number" class="form-control" name="amount" placeholder="Enter price" />
                  </div>
                </div>
              </div>

              <!-- Academic Info Section -->
              <div class="mb-4">
                <h6 class="fw-bold text-primary mb-3"><i class="fa fa-graduation-cap me-2"></i>Academic Information</h6>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label">University <span class="text-danger">*</span></label>
                    <select class="form-select select2" name="university" data-typeahead-source='<?php echo json_encode($universities); ?>'>
                      <?php foreach ($universities as $university) : ?>
                        <option><?php echo htmlspecialchars($university); ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Faculty <span class="text-danger">*</span></label>
                    <select class="form-select select2" name="faculty" data-typeahead-source='<?php echo json_encode($faculties); ?>'>
                      <?php foreach ($faculties as $faculty) : ?>
                        <option><?php echo htmlspecialchars($faculty); ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Department <span class="text-danger">*</span></label>
                    <select class="form-select select2" name="dept" data-typeahead-source='<?php echo json_encode($departments); ?>'>
                      <?php foreach ($departments as $department) : ?>
                        <option><?php echo htmlspecialchars($department); ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Course <span class="text-danger">*</span></label>
                    <select class="form-select select2" name="course" data-typeahead-source='<?php echo json_encode($courses); ?>'>
                      <?php foreach ($courses as $course) : ?>
                        <option><?php echo htmlspecialchars($course); ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Level <span class="text-danger">*</span></label>
                    <select class="form-select select2" name="level">
                      <option value="Current Level">Current Level</option>
                      <option value="100">100L</option>
                      <option value="200">200L</option>
                      <option value="300">300L</option>
                      <option value="400">400L</option>
                      <option value="500">500L</option>
                    </select>
                  </div>
                </div>
              </div>

              <!-- Upload Section -->
              <div class="mb-4">
                <h6 class="fw-bold text-primary mb-3"><i class="fa fa-file-upload me-2"></i>Upload File</h6>
                <div class="row g-3">
                  <div class="col-12">
                    <label class="form-label">Book/Project File (PDF) <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="book" accept=".pdf" required />
                    <small class="text-muted">Maximum file size: 50MB</small>
                  </div>
                </div>
              </div>

              <div class="d-flex justify-content-end gap-2">
                <a href="profilepage" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
                <button type="submit" name="search" class="btn btn-primary rounded-pill px-4">
                  <i class="fa fa-upload me-2"></i>Upload Book
                </button>
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
  <script src="assets/js/material-dashboard.min.js?v=3.0.4"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

  <script>
    $(document).ready(function() {
      $('.select2').select2({
        tags: true,
        placeholder: 'Select or type...'
      });
    });

    // Show/hide amount field based on type selection
    document.getElementById('option-select-type').addEventListener('change', function() {
      var amountInputContainer = document.getElementById('amount-input-container');
      if (this.value === 'Projects') {
        amountInputContainer.style.display = 'block';
      } else {
        amountInputContainer.style.display = 'none';
      }
    });

    // Initial check
    document.getElementById('option-select-type').dispatchEvent(new Event('change'));
  </script>
</body>

</html>