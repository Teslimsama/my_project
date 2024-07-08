<?php include "session.php";
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
  <?php include "meta.php" ?>
  <title>
    Profile page || Unibooks
  </title>
  <!--     Fonts and icons     -->
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
  <link id="pagestyle" href="assets/css/profile.css" rel="stylesheet">
  <script src="assets/js/jquery.min.js"></script>

  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9952650109664010" crossorigin="anonymous"></script>
</head>

<body>
  <div class="container">
    <div class="row">

      <div class="card mt-5 col-lg-12  col-sm-12 bg-light ">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-center text-capitalize ps-3">Update Your Details</h6>
          </div>
        </div>
        <div class="card-body">
          <form action="update.app.php " enctype="multipart/form-data" method="POST">
            <div class="row">
              <div class="col-md-6">
                <label for="">Firstname</label>
                <input type="text" class="form-control ps-4" style="border: 2px solid grey ;" name="firstname" value="<?php echo $user['firstname']; ?>" placeholder="first name">

              </div>
              <div class="col-md-6">
                <label for="">Lastname</label>
                <input type="lastname" class="form-control ps-4" style="border: 2px solid grey ;" name="lastname" value="<?php echo $user['lastname']; ?>" placeholder="last name">

              </div>

              <div class="col-md-6">
                <label for="">Current Password</label>
                <input type="password" class="form-control ps-4" style="border: 2px solid grey ;" name="password" value="<?php echo $user['password']; ?>">

              </div>

              <div class="col-md-6">
                <label for="">Phone number</label>
                <input type="tel" class="form-control ps-4" style="border: 2px solid grey ;" name="phone" value="<?php echo $user['phone']; ?>" placeholder="phone eg.0801223347">

              </div>
              <div class="col-md-6">
                <label for="">Upload Image </label>
                <input type="file" class="form-control ps-4" id="photo" style="border: 2px solid grey ;" name="photo">
              </div>

              <div class="col-md-6">
                <label for="">Level</label>
                <input type="text" class="form-control ps-4" style="border: 2px solid grey ;" name="levell" placeholder="Current Level" value="<?php echo $user['level']; ?>">

              </div>
              <!-- <div class="col-md-6">
                <label for="">Faculty</label>
                <input type="text" class="form-control ps-4" style="border: 2px solid grey ;" name="faculty" placeholder="faculty" value="<?php echo $user['faculty']; ?>">

              </div> -->
              <div class="col-md-6">
                <label for="">University</label>
                <select style="border: 2px solid grey ;" name="university" id="university" class="form-control action">
                  <option value="">Select university</option>
                  <?php echo $university; ?>
                </select>
              </div>
              <div class="col-md-6 p-2">
                <label for="">Faculty</label>
                <select style="border: 2px solid grey ;" name="faculty" id="faculty" class="form-control action">
                  <option value="">Select faculty</option>
                </select>
              </div>
              <div class="col-md-6 p-2">
                <label for="">Department</label>
                <select style="border: 2px solid grey ;" name="dept" id="department" class="form-control action">
                  <option value="">Select department</option>
                </select>
              </div>
              <div class="col-md-6 p-2">
                <label for="">Department</label>
                <select style="border: 2px solid grey ;" name="course" id="course" class="form-control">
                  <option value="">Select course</option>
                </select>
              </div>

              <div class="mt-4 col-md-6">
                <label for="">Date of birth</label>
                <input type="date" class="form-control ps-4" style="border: 2px solid grey ;" name="dob" placeholder="" value="<?php echo $user['dob']; ?>">
              </div>
              <div class="col-md-6 ">
                <label for="">Password</label>
                <input type="password" class="form-control ps-4" style="border: 2px solid grey ;" name="curr_password" placeholder="input current password to save changes" required>

              </div>

            </div>
            <div class="form-group col-md-12 p-2">
              <input type="submit" class="btn btn-primary" name="submit" value="Submit">
              <a class="btn btn-link ml-2" href="profilepage">Cancel</a>
            </div>
          </form>
        </div>
      </div>


    </div>

  </div>
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

</body>

</html>