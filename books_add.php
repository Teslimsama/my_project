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
  <title>
    Downloads || Unibooks
  </title>
  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
  <link id="pagestyle" href="assets/css/faq.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/corejs-typeahead/1.3.0/typeaheadjs.css">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9952650109664010" crossorigin="anonymous"></script>
</head>

<body class="g-sidenav-show  bg-gray-200">
  <?php include 'sidebar.php' ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="index">Home</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Downloads</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Downloads</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <form action="search" method="GET">
              <div class="input-group input-group-outline">
                <label class="form-label">Type here...</label>
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
                <h4 class="card-title">Upload Book Details</h4>
                <form method="POST" enctype="multipart/form-data" action="search.app.php" autocomplete="off">
                  <p class="card-description"> Book info </p>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="input-group input-group-outline row">
                        <label class="col-sm-3 col-form-label">Title</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="title" required />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group input-group-outline row">
                        <label class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                          <textarea class="form-control" name="desc" required></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="input-group input-group-outline row">
                        <label class="col-sm-3 col-form-label">Keywords</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="keywords" required />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group input-group-outline row">
                        <label class="col-sm-3 col-form-label">Type</label>
                        <div class="col-sm-9">
                          <select class="form-select select" id="option-select-type" name="type">
                            <option value="Books">Books</option>
                            <option value="Projects">Projects</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <p class="card-description"> Academic Info </p>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="input-group input-group-outline row">
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
                      <div class="input-group input-group-outline row">
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
                      <div class="input-group input-group-outline row">
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
                      <div class="input-group input-group-outline row">
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
                      <div class="input-group input-group-outline row">
                        <label class="col-sm-3 col-form-label">Level</label>
                        <div class="col-sm-9">
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
                    <div class="col-md-6">
                      <div class="input-group input-group-outline row" id="amount-input-container" style="display: none;">
                        <label class="col-sm-3 col-form-label">Amount</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" name="amount" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- <p class="card-description"> Upload Files </p> -->
                  <div class="row">
                    <!-- <div class="col-md-6">
                   <div class="input-group input-group-outline row">
                     <label class="col-sm-3 col-form-label">Upload Image</label>
                     <div class="col-sm-9">
                       <input type="file" class="form-control" name="img" />
                     </div>
                   </div>
                 </div> -->
                    <div class="col-md-6">
                      <div class="input-group input-group-outline row py-3">
                        <label class="col-sm-3 col-form-label">Upload Book</label>
                        <div class="col-sm-9">
                          <input type="file" class="form-control" name="book" required />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="input-group input-group-outline row">
                    <div class="col-sm-12">
                      <button type="submit" name="search" class="btn btn-primary">Submit</button>
                    </div>
                  </div>
                </form>
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
  <?php include "plugin.php" ?>
  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/corejs-typeahead/1.3.0/typeahead.bundle.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
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
  <script>
    document.getElementById('option-select-type').addEventListener('change', function() {
      var amountInputContainer = document.getElementById('amount-input-container');
      if (this.value === 'Projects') {
        amountInputContainer.style.display = 'block';
      } else {
        amountInputContainer.style.display = 'none';
      }
    });

    // Initial check in case the page loads with the 'Projects' option selected
    document.getElementById('option-select-type').dispatchEvent(new Event('change'));
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.min.js?v=3.0.4"></script>
</body>

</html>