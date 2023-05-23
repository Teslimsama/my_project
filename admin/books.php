<?php include "session.php" ?>
<?php
$university = '';
$query = "SELECT university FROM university_faculty_department GROUP BY university ORDER BY university ASC";
$stmt = $conn->prepare($query);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $university .= '<option value="' . $row["university"] . '">' . $row["university"] . '</option>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../Images/apple-touch-icon.png">
  <link rel="shortcut icon" type="image/png" href="../Images/android-chrome-512x512.png">
  <title>
    Books || UniBooks
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/e9de02addb.js" crossorigin="anonymous"></script>

  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
  <link id="pagestyle" href="../assets/css/faq.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


</head>

<body class="g-sidenav-show  bg-gray-200">
  <?php include "sidebar.php" ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Books</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Books</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
              <label class="form-label">Type here...</label>
              <input type="text" class="form-control">
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">Lists of Books</h6>
            </div>
          </div>
          <div class="card-body px-0 pb-2">

            <table id="product_data" class="table align-items-center justify-content-center mb-0 table-responsive p-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Book</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Price</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Type</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">University</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Faculty</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Department</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Level</th>
                  <th></th>

                </tr>
              </thead>

            </table>

          </div>
        </div>
      </div>

      <div class="container-fluid py-4">
        <!-- footer  -->
        <div class="container-fluid bg- mt-5 ">
          <footer class="py-3 my-4 ">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
              <li class="nav-item"><a href="about_us" class="nav-link px-2 text-light">Home</a></li>
              <li class="nav-item"><a href="#" class="nav-link px-2 text-light">More Website</a></li>
              <li class="nav-item"><a href="donate" class="nav-link px-2 text-light">Donate</a></li>
              <li class="nav-item"><a href="faq" class="nav-link px-2 text-light">FAQs</a></li>
              <li class="nav-item"><a href="about_us" class="nav-link px-2 text-light">About Us</a></li>
            </ul>
            <p class="text-center text-light">&copy;
              <script>
                document.write(new Date().getFullYear())
              </script><a href=""> Testech, Ltd</a>
            </p>

          </footer>
        </div>
        <!-- footer  -->
      </div>
    </div>
  </main>
  <?php
  include "books_modal.php";
  include "plugin.php";
  ?>

  <!--   Core JS Files   -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script type="text/javascript" language="javascript">
    $(document).ready(function() {
      $('#add_button').click(function() {
        $('#product_form')[0].reset();
        $('.modal-title').text("Add User");
        $('#action').val("Add");
        $('#operation').val("Add");
        $('#product_uploaded_image').html('');
      });

      var dataTable = $('#product_data').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
          url: "fetch.php",
          type: "POST"
        },
        "columnDefs": [{
          "targets": [0, 3, 4],
          "orderable": false,
        }, ],

      });

      $(document).on('submit', '#product_form', function(event) {
        event.preventDefault();
        var product_name = $('#product_name').val();
        var product_price = $('#product_price').val();
        var type = $('#type').val();
        var university = $('#university').val();
        var faculty = $('#faculty').val();
        var desc = $('#desc').val();
        var keywords = $('#keywords').val();
        var department = $('#department').val();
        var level = $('#level').val();
        var extension = $('#product_image').val().split('.').pop().toLowerCase();
        if (extension != '') {
          if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
            alert("Invalid Image File");
            $('#product_image').val('');
            return false;
          }
        }
        if (product_price != '' && product_name != '') {
          $.ajax({
            url: "insert.php",
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(data) {
              alert(data);
              $('#product_form')[0].reset();
              $('#productModal').modal('hide');
              dataTable.ajax.reload();
            }
          });
        } else {
          alert("Both Fields are Required");
        }
      });

      $(document).on('click', '.update', function() {
        var product_id = $(this).attr("id");
        $.ajax({
          url: "fetch_single.php",
          method: "POST",
          data: {
            product_id: product_id
          },
          dataType: "json",
          success: function(data) {
            $('#productModal').modal('show');
            $('#product_name').val(data.product_name);
            $('#product_price').val(data.product_price);
            $('#type').val(data.type);
            $('#course').val(data.course);
            $('#university').val(data.university);
            $('#desc').val(data.description);
            $('#keywords').val(data.keywords);
            $('#faculty').val(data.faculty);
            $('#department').val(data.department);
            $('#level').val(data.level);
            $('.modal-title').text("Edit Details");
            $('#product_id').val(product_id);
            $('#product_uploaded_image').html(data.product_image);
            $('#action').val("Edit");
            $('#operation').val("Edit");
          }
        })
      });

      $(document).on('click', '.delete', function() {
        var product_id = $(this).attr("id");
        if (confirm("Are you sure you want to delete this?")) {
          $.ajax({
            url: "delete.php",
            method: "POST",
            data: {
              product_id: product_id
            },
            success: function(data) {
              alert(data);
              dataTable.ajax.reload();
            }
          });
        } else {
          return false;
        }
      });


    });
  </script>
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
      $('.action').change(function() {
        if ($(this).val() != '') {
          var action = $(this).attr("id");
          var query = $(this).val();
          var result = '';
          if (action == "university") {
            result = 'faculty';
          } else if (action == "faculty") {
            result = 'department';
          } else if (action == "department") {
            result = 'course';
          } else {
            result = '';
          }
          $.ajax({
            url: "uni_fetch.php",
            method: "POST",
            data: {
              action: action,
              query: query
            },
            success: function(data) {
              $('#' + result).html(data);
              if (result != 'course') {
                $('#course').html('<option value="">Select course</option>');
              }
            }
          })
        }
      });
    });
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.0.4"></script>

</body>

</html>