<?php include "session.php";

if (isset($_POST['upload'])) {

  if ($_FILES['photo']['error'] === 4) {
    echo
    "<script> alert('does not exist');</script>";
  } else {
    $fileName = $_FILES["photo"]["name"];
    $fileSize = $_FILES["photo"]["size"];
    $tmpName = $_FILES["photo"]["tmp_name"];

    $validExt = ['jpg', 'png', 'jpeg'];
    $Ext = explode('.', $fileName);
    $Ext = strtolower(end($Ext));
    if (!in_array($Ext, $validExt)) {
      echo  "<script> alert('invalid file format');</script>";
    } elseif ($fileSize > 100250) {
      echo
      "<script> alert('the image is too large');</script>";
    } else {
      $newFileName = 'IMG';
      $newFileName .= uniqid();
      $newFileName .= '.' . $Ext;
      $location = 'pfp/' . $newFileName;
      move_uploaded_file($tmpName, $location);
      $query = "UPDATE `uniphotoer` SET `image` = '$newFileName' WHERE `uniphotoer`.`id` = $update;";
      mysqli_query($db_connect, $query);

      echo
      "<script> alert('Successfully Added');
        </script>";
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="Images/apple-touch-icon.png">
  <link rel="shortcut icon" type="image/png" href="Images/android-chrome-512x512.png">
  <title>
    Profile page || Uniphotos
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
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9952650109664010" crossorigin="anonymous"></script>
</head>

<body>
  <style>
    .image {
      width: 65em;
    }

    .row {
      --bs-gutter-x: 1.5rem;
      --bs-gutter-y: 0;
      display: flex;
      flex-wrap: wrap;
      margin-top: calc(-1 * var(--bs-gutter-y));
      margin-right: calc(-.5 * var(--bs-gutter-x));
      margin-left: calc(-.5 * var(--bs-gutter-x));
      justify-content: center;

    }


    @media screen and (max-width:400px) {

      .row {
        --bs-gutter-x: 1.5rem;
        --bs-gutter-y: 0;
        display: flex;
        flex-wrap: wrap;
        margin-top: calc(-1 * var(--bs-gutter-y));
        margin-right: calc(-.5 * var(--bs-gutter-x));
        margin-left: calc(-.5 * var(--bs-gutter-x));
        justify-content: space-between;

      }

      body {
        background-image: url(assets/css/pexels-artem-beliaikin-1153976.jpg);

        background-size: cover;
        background-repeat: no-repeat;
        height: 100%;

      }
    }

    @media screen and (max-width:800px) {
      .image {
        width: 65em;
      }

      .detail {
        width: 80em;
      }

      .row {
        --bs-gutter-x: 1.5rem;
        --bs-gutter-y: 0;
        display: flex;
        flex-wrap: wrap;
        margin-top: calc(-1 * var(--bs-gutter-y));
        margin-right: calc(-.5 * var(--bs-gutter-x));
        margin-left: calc(-.5 * var(--bs-gutter-x));
        justify-content: center;

      }

      body {
        background-image: url(Images/pexels-pixabay-207691.jpg);

        background-size: cover;
        background-repeat: no-repeat;
        height: 100%;

      }
    }
  </style>
  <div class="container">
    <div class="row">

      <div class="card vw-100 mt-5 col-lg-6 detail col-sm-6 bg-light ">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-center text-capitalize ps-3">Update Your Details</h6>
          </div>
        </div>
        <div class="card-body">
          <form action="update.app.php " enctype="multipart/form-data" method="POST">
            <div class="first">
              <label for="">Firstname</label>
              <input type="text" class="form-control" name="firstname" value="<?php echo $user['firstname']; ?>" placeholder="first name">

            </div>
            <div class="last ">
              <label for="">Lastname</label>
              <input type="lastname" class="form-control" name="lastname" value="<?php echo $user['lastname']; ?>" placeholder="last name">

            </div>

            <div class="last ">
              <label for="">Current Password</label>
              <input type="password" class="form-control" name="password" value="<?php echo $user['password']; ?>">

            </div>

            <!-- <div class="user">
              <label>Username</label>
              <input type="text" name="username" value="<?php echo $user['username']; ?>" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>">
              <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div> -->

            <div class="phone">
              <label for="">Phone number</label>
              <input type="tel" class="form-control" name="phone" value="<?php echo $user['phone']; ?>" placeholder="phone eg.0801223347">

            </div>
            <div class="upload p-2 form-control">
              <label for="">Upload Image </label>
              <input type="file" class="form-control" id="photo" name="photo">
            </div>

            <div class="level">
              <label for="">Level</label>
              <input type="text" class="form-control" name="levell" placeholder="Current Level" value="<?php echo $user['level']; ?>">

            </div>
            <div class="faculty">
              <label for="">Faculty</label>
              <input type="text" class="form-control" name="faculty" placeholder="faculty" value="<?php echo $user['faculty']; ?>">

            </div>
            <div class="Department">
              <label for="">Department</label>
              <input type="text" class="form-control" name="dept" placeholder="Department" value="<?php echo $user['department']; ?>">

            </div>
            <div class="course">
              <label for="">Course of Study</label>
              <input type="text" class="form-control" name="course" placeholder="Course of Study" value="<?php echo $user['course']; ?>">

            </div>
            <div class="email">
              <label for="">Email</label>
              <input type="email" class="form-control" name="email" placeholder="valid email" value="<?php echo $user['email']; ?>">
            </div>

            <div class="mt-4">
              <label for="">Date of birth</label>
              <input type="date" class="form-control" name="dob" placeholder="" value="<?php echo $user['dob']; ?>">
            </div>
            <div class="last ">
              <label for="">Password</label>
              <input type="password" class="form-control" name="curr_password" placeholder="input current password to save changes" required>

            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-primary" name="submit" value="Submit">
              <a class="btn btn-link ml-2" href="profilepage">Cancel</a>
            </div>
          </form>
        </div>
      </div>

    </div>

  </div>


</body>

</html>