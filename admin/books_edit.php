<?php include "session.php"; ?>
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
  <link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
  <link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include 'navbar.php'; ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?php include 'sidebar.php'; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <div class="msg">
                  <?php echo ErrorMessage();
                  echo SuccessMessage(); ?>
                </div>
                <h4 class="card-title">Horizontal Two Column</h4>
                <form class="form-sample" method="post" action="insert.php" id="product_form" enctype="multipart/form-data">
                  <p class="card-description">Product Info</p>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Product Name</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="product_name" name="title" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="description" name="desc" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Keywords</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="keywords" name="keywords" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Product Price</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="product_price" name="amount" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">University</label>
                        <div class="col-sm-9">
                          <select class="form-select" id="university" name="university">
                            <!-- Options will be populated by JavaScript -->
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
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
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Type</label>
                        <div class="col-sm-9">
                          <select class="form-select" id="type" name="type">
                            <!-- Options will be populated by JavaScript -->
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
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
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Department</label>
                        <div class="col-sm-9">
                          <select class="form-select" id="department" name="dept">
                            <!-- Options will be populated by JavaScript -->
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
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
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Product Image</label>
                        <div class="col-sm-9">
                          <div id="product_image">
                            <!-- Image will be populated by JavaScript -->
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Upload Book</label>
                        <div class="col-sm-9">
                          <input type="file" class="form-control" name="book" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="edit_id" id="edit_id" value="">

                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
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
  <script src="assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <script src="assets/vendors/select2/select2.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/template.js"></script>
  <script src="assets/js/settings.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="assets/js/file-upload.js"></script>
  <script src="assets/js/typeahead.js"></script>
  <script src="assets/js/select2.js"></script>
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
            $('#edit_id').val(productID);
          }
        });
      }

      // $('#product_form').on('submit', function(event) {
      //   event.preventDefault();
      //   var formData = new FormData(this);

      //   $.ajax({
      //     url: "insert.php",
      //     method: 'POST',
      //     data: formData,
      //     contentType: false,
      //     processData: false,
      //     success: function(response) {
      //       var data = JSON.parse(response);
      //       if (data.status === 'success') {
      //         alert(data.message);
      //         window.location.href = 'books.php'; // Redirect to books.php
      //       } else {
      //         alert(data.message);
      //       }
      //     },
      //     error: function(xhr, status, error) {
      //       console.error(error);
      //     }
      //   });
      // });
    });
  </script>
  <!-- End custom js for this page-->
</body>

</html>