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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/corejs-typeahead/1.3.0/typeaheadjs.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <?php include 'navbar.php'; ?>
    <div class="container-fluid page-body-wrapper">
      <?php include 'sidebar.php'; ?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <div class="msg">
                  <?php echo ErrorMessage();
                  echo SuccessMessage(); ?>
                </div>
                <h4 class="card-title">Upload Book Details</h4>
                <form method="POST" enctype="multipart/form-data" action="search.app.php" autocomplete="off">
                  <p class="card-description"> Book info </p>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Title</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="title" required />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                          <textarea class="form-control" name="desc" required></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Keywords</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="keywords" required />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Type</label>
                        <div class="col-sm-9">
                          <select class="form-select select2" name="type">
                            <option value="1">Books</option>
                            <option value="0">Projects</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <p class="card-description"> Academic Info </p>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">University</label>
                        <div class="col-sm-9">
                          <select class="form-select select2" name="university" data-typeahead-source='<?php echo json_encode($universities); ?>'>
                            <?php foreach ($universities as $university) : ?>
                              <option><?php echo htmlspecialchars($university); ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Faculty</label>
                        <div class="col-sm-9">
                          <select class="form-select select2" name="faculty" data-typeahead-source='<?php echo json_encode($faculties); ?>'>
                            <?php foreach ($faculties as $faculty) : ?>
                              <option><?php echo htmlspecialchars($faculty); ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Department</label>
                        <div class="col-sm-9">
                          <select class="form-select select2" name="dept" data-typeahead-source='<?php echo json_encode($departments); ?>'>
                            <?php foreach ($departments as $department) : ?>
                              <option><?php echo htmlspecialchars($department); ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Course</label>
                        <div class="col-sm-9">
                          <select class="form-select select2" name="course" data-typeahead-source='<?php echo json_encode($courses); ?>'>
                            <?php foreach ($courses as $course) : ?>
                              <option><?php echo htmlspecialchars($course); ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Level</label>
                        <div class="col-sm-9">
                          <select class="form-select select2" name="level">
                            <option>Current Level</option>
                            <option value="100">100L</option>
                            <option value="200">200L</option>
                            <option value="300">300L</option>
                            <option value="400">400L</option>
                            <option value="500">500L</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Amount</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" name="amount" required />
                        </div>
                      </div>
                    </div>
                  </div>
                  <p class="card-description"> Upload Files </p>
                  <div class="row">
                    <!-- <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Upload Image</label>
                        <div class="col-sm-9">
                          <input type="file" class="form-control" name="img" />
                        </div>
                      </div>
                    </div> -->
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Upload Book</label>
                        <div class="col-sm-9">
                          <input type="file" class="form-control" name="book" required />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <button type="submit" name="search" class="btn btn-primary">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

        </div>
        <?php include 'footer.php'; ?>
      </div>
    </div>
  </div>
  <!-- plugins:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/corejs-typeahead/1.3.0/typeahead.bundle.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.select2').select2({
        tags: true
      });

      $('select[data-typeahead-source]').each(function() {
        var $this = $(this);
        var data = $this.data('typeahead-source');

        $this.select2({
          tags: true,
          data: data
        });

        var substringMatcher = function(strs) {
          return function findMatches(q, cb) {
            var matches, substringRegex;

            matches = [];

            substrRegex = new RegExp(q, 'i');

            $.each(strs, function(i, str) {
              if (substrRegex.test(str)) {
                matches.push(str);
              }
            });

            cb(matches);
          };
        };

        $this.parent().find('.select2-search__field').typeahead({
          hint: true,
          highlight: true,
          minLength: 1
        }, {
          name: 'data',
          source: substringMatcher(data)
        });
      });
    });
  </script>
</body>

</html>