<?php
include "session.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "meta.php" ?>
  <title>
    Library || Unibooks
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />


  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/e9de02addb.js" crossorigin="anonymous"></script>


  <script async src="https://page.phpad2.googlesyndication.com/page.phpad/js/adsbygoogle.js?client=ca-pub-9952650109664010" crossorigin="anonymous"></script>



  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="page.phpstyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/content.css">
  <link rel="stylesheet" href="assets/css/app.css">
</head>

<body class="bg-light">
  <?php include "header_app.php"; ?>

  <main class="container-fluid pb-5">
    <div class="d-md-none p-3">
      <div class="search-container m-0">
        <i class="fa fa-search search-icon"></i>
        <input type="text" id="search_box_mobile" class="search-input" placeholder="Search...">
      </div>
    </div>

    <div class="library-grid" id="post_data">
      <!-- AJAX data will be loaded here -->
    </div>

    <div id="pagination_link" class="d-flex justify-content-center py-4"></div>

    <?php include "footer.php" ?>
  </main>

  <?php include "bottom_nav_app.php"; ?>
  <?php include "plugin.php" ?>
  <!-- <script>
      load_data();

      function load_data(query = "", page_number = 1) {
        var form_data = new FormData();

        form_data.append("query", query);

        form_data.append("page", page_number);

        var ajax_request = new XMLHttpRequest();

        ajax_request.open("POST", "process_data.php");

        ajax_request.send(form_data);

        ajax_request.onreadystatechange = function() {
          if (ajax_request.readyState == 4 && ajax_request.status == 200) {
            var response = JSON.parse(ajax_request.responseText);

            var html = "";

            var serial_no = 1;

            if (response.data.length > 0) {
              for (var count = 0; count < response.data.length; count++) {
                html += `
      <div class='pic card bg-gradient-light mt-3'>
          <img class='' src='assets/Images/` + response.data[count].image + `' height='' alt='` + response.data[count].name + `' style='width: 100%;'>
          
          <input type='hidden' name= '` + response.data[count].id + `'>
          <a href='description_page?id=` + response.data[count].id + `&book=` + response.data[count].link + `'>
            <div class='container name '>
              <h6>` + response.data[count].name + `</h6>
              
          </a>
        </div>
      </div> 
        `;
                serial_no++;
              }
            } else {
              html +=
                '<h3 class="text-center">No Data Found</h3>';
            }

            document.getElementById("post_data").innerHTML = html;

            // document.getElementById("total_data").innerHTML = response.total_data;

            document.getElementById("pagination_link").innerHTML = response.pagination;
          }
        };
      }
    </script> -->

  <script>
    load_data();

    function load_data(query = "", page_number = 1) {
      var form_data = new FormData();
      form_data.append("query", query);
      form_data.append("page", page_number);

      var ajax_request = new XMLHttpRequest();
      ajax_request.open("POST", "process_data.php");
      ajax_request.send(form_data);

      ajax_request.onreadystatechange = function() {
        if (ajax_request.readyState == 4 && ajax_request.status == 200) {
          var response = JSON.parse(ajax_request.responseText);

          var html = "";
          var serial_no = 1;

          if (response.data.length > 0) {
            for (var count = 0; count < response.data.length; count++) {
              html += `
                        <div class='book-card'>
                            <div class="book-image-wrapper">
                                <img class='book-image' src='assets/Images/${response.data[count].image}' alt='${response.data[count].name}'>
                            </div>
                            <div class='book-info'>
                                <h6 class='book-title'>${response.data[count].name}</h6>
                                <a href='description_page?id=${response.data[count].id}&book=${response.data[count].link}' class="btn btn-primary btn-sm w-100 rounded-pill mt-2">View Details</a>
                            </div>
                        </div>`;
              serial_no++;
            }
          } else {
            html += '<h3 class="text-center">No Data Found</h3>';
          }

          document.getElementById("post_data").innerHTML = html;
          document.getElementById("pagination_link").innerHTML = response.pagination;
        }
      }
    }

    // Attach the keyup event listener to the search box
    document.getElementById('search_box_desktop').addEventListener('keyup', function() {
      load_data(this.value);
    });
    document.getElementById('search_box_mobile').addEventListener('keyup', function() {
      load_data(this.value);
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
  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>


  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Library: parallax effects, scripts for the example page.phps etc -->
  <script src="assets/js/material-dashboard.min.js?v=3.0.4"></script>
</body>

</html>