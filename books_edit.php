<?php include "session.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "meta.php" ?>
  <title>
    Downloads || Unibooks
  </title>
  <!--     Fonts and icons     -->
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
  <!-- <link rel="stylesheet" href="assets/css/cheatsheet.css"> -->
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
      <div class="col-12 mt-5">
        <div class="content-wrapper">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <div class="msg">
                  <?php echo ErrorMessage();
                  echo SuccessMessage(); ?>
                </div>
                <h4 class="card-title">Horizontal Two Column</h4>
                <form class="form-sample" method="post" id="product_form" enctype="multipart/form-data">
                  <p class="card-description">Product Info</p>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="input-group input-group-outline row">
                        <label class="col-sm-3 col-form-label">Product Name</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="product_name" name="product_name" readonly />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group input-group-outline row">
                        <label class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="description" name="description" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="input-group input-group-outline row">
                        <label class="col-sm-3 col-form-label">Keywords</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="keywords" name="keywords" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group input-group-outline row">
                        <label class="col-sm-3 col-form-label">Product Price</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="product_price" name="product_price" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="input-group input-group-outline row">
                        <label class="col-sm-3 col-form-label">University</label>
                        <div class="col-sm-9">
                          <select class="form-select" id="university" name="university">
                            <!-- Options will be populated by JavaScript -->
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group input-group-outline row">
                        <label class="col-sm-3 col-form-label">Level</label>
                        <div class="col-sm-9">
                          <select class="form-select" id="level" name="level">
                            <!-- Options will be populated by JavaScript -->
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="input-group input-group-outline row">
                        <label class="col-sm-3 col-form-label">Type</label>
                        <div class="col-sm-9">
                          <select class="form-select" id="type" name="type">
                            <!-- Options will be populated by JavaScript -->
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group input-group-outline row">
                        <label class="col-sm-3 col-form-label">Faculty</label>
                        <div class="col-sm-9">
                          <select class="form-select" id="faculty" name="faculty">
                            <!-- Options will be populated by JavaScript -->
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
                          <select class="form-select" id="department" name="department">
                            <!-- Options will be populated by JavaScript -->
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group input-group-outline row">
                        <label class="col-sm-3 col-form-label">Course</label>
                        <div class="col-sm-9">
                          <select class="form-select" id="course" name="course">
                            <!-- Options will be populated by JavaScript -->
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="input-group input-group-outline row">
                        <label class="col-sm-3 col-form-label">Product Image</label>
                        <!-- <input type="file" class="form-control " name="product_image" id="product_image"> -->
                        <div class="col-sm-9" id="product_image">
                          <!-- Image will be populated by JavaScript -->
                        </div>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="product_id" id="product_id" />
                  <input type="hidden" name="operation" id="operation" />
                  <button type="submit" name="action" id="action" class="btn btn-primary">Submit</button>
                </form>
              </div>
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
  <?php include "plugin.php" ?>

  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <!-- Custom js for this page-->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Custom js for this page-->
  <script src="admin/assets/js/file-upload.js"></script>
  <script src="admin/assets/js/typeahead.js"></script>
  <script src="admin/assets/js/select2.js"></script>
  <script>
    $(document).ready(function() {
      var urlParams = new URLSearchParams(window.location.search);
      var productID = urlParams.get('id');

      if (productID) {
        $.ajax({
          url: 'fetch_single.php',
          type: 'GET',
          data: {
            id: productID
          },
          dataType: 'json',
          success: function(data) {
            $('#product_name').val(data.product_name);
            $('#description').val(data.description);
            $('#keywords').val(data.keywords);
            $('#product_price').val(data.product_price);
            $('#university').html(data.universitySelect);
            $('#level').html(data.levelSelect);
            $('#type').html(data.typeSelect);
            $('#faculty').html(data.facultySelect);
            $('#department').html(data.departmentSelect);
            $('#course').html(data.courseSelect);
            $('#product_image').html(data.product_image);
            $('#action').val("Edit");
            $('#operation').val("Edit");
            $('#product_id').val(productID);
          }
        });
      }

      $('#product_form').on('submit', function(event) {
        event.preventDefault();
        // Add your form submission logic here
      });
    });
    $(document).on('submit', '#product_form', function(event) {
      event.preventDefault();
      var formData = new FormData(this);

      $.ajax({
        url: "insert.php",
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
          var data = JSON.parse(response);
          if (data.status === 'success') {
            alert(data.message);
            window.location.href = 'books.php'; // Redirect to books.php
          } else {
            alert(data.message);
          }
        },
        error: function(xhr, status, error) {
          console.error(error);
        }
      });
    });
  </script>
  <!-- End custom js for this page-->
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.min.js?v=3.0.4"></script>
</body>

</html>