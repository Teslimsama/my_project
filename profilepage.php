<?php
include "session.php"; // Ensure this file starts the session and initializes the $user variable

if (!isset($_SESSION['user'])) {
  header('location: index.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "meta.php" ?>
  <title>Profile || Unibooks</title>
  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/e9de02addb.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/app.css">
</head>

<body class="bg-light">
  <?php include "header_app.php"; ?>

  <div class="main-content container-fluid py-4">
    <div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('assets/Images/pexels-engin-akyurt-2943603_24685434.jpg');">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>
      <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row gx-4 mb-2">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="<?php echo (!empty($user['image'])) ? $user['image'] : 'assets/Images/noimage.jpg'; ?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm" style="object-fit: cover; height: 100%;">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                <?php echo $user['firstname'] . ' ' . $user['lastname']; ?>
              </h5>
              <p class="mb-0 font-weight-normal text-sm">
                Student &nbsp;|&nbsp; <?php echo $user['school']; ?>
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
            <div class="nav-wrapper position-relative end-0 text-end">
              <a href="update_details" class="btn btn-outline-primary btn-sm mb-0 rounded-pill">
                <i class="fas fa-user-edit me-2"></i>Edit Profile
              </a>
            </div>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-12 col-xl-4 mb-4">
            <div class="card h-100 border-0 shadow-sm bg-gray-100">
              <div class="card-header pb-0 p-3 bg-transparent">
                <div class="row">
                  <div class="col-md-8 d-flex align-items-center">
                    <h6 class="mb-0 fw-bold"><i class="fa fa-id-card me-2 text-primary"></i>Profile Details</h6>
                  </div>
                </div>
              </div>
              <div class="card-body p-3">
                <?php echo ErrorMessage();
                echo SuccessMessage(); ?>
                <ul class="list-group">
                  <li class="list-group-item border-0 ps-0 text-sm bg-transparent"><strong class="text-dark"><i class="fa fa-user me-2 text-muted" style="width:20px"></i>Username:</strong> &nbsp; <?php echo $user['username']; ?></li>
                  <li class="list-group-item border-0 ps-0 text-sm bg-transparent"><strong class="text-dark"><i class="fa fa-phone me-2 text-muted" style="width:20px"></i>Mobile:</strong> &nbsp; <?php echo $user['phone']; ?></li>
                  <li class="list-group-item border-0 ps-0 text-sm bg-transparent"><strong class="text-dark"><i class="fa fa-envelope me-2 text-muted" style="width:20px"></i>Email:</strong> &nbsp; <?php echo $user['email']; ?></li>
                  <li class="list-group-item border-0 ps-0 text-sm bg-transparent"><strong class="text-dark"><i class="fa fa-graduation-cap me-2 text-muted" style="width:20px"></i>Level:</strong> &nbsp; <?php echo $user['level']; ?></li>
                  <li class="list-group-item border-0 ps-0 text-sm bg-transparent"><strong class="text-dark"><i class="fa fa-building me-2 text-muted" style="width:20px"></i>Faculty:</strong> &nbsp; <?php echo $user['faculty']; ?></li>
                </ul>
              </div>
            </div>
          </div>

          <div class="col-12 col-xl-8">
            <div class="mb-3 ps-3">
              <h6 class="mb-0 fw-bold"><i class="fa fa-book me-2 text-primary"></i>Relevant Books For You</h6>
              <p class="text-sm text-muted">Curated based on your faculty and level</p>
            </div>

            <div class="library-grid px-0 py-0" style="gap: 1rem; padding: 0 !important; max-width: 100%;">
              <?php
              $faculty = $user['faculty'];
              $department = $user['department'];
              $level = $user['level'];
              $sql = "SELECT * FROM producttb WHERE faculty LIKE :faculty OR department LIKE :department OR level LIKE :level LIMIT 8";
              $query = $conn->prepare($sql);
              $query->execute([':faculty' => "%$faculty%", ':department' => "%$department%", ':level' => "%$level%"]);
              $numrows = $query->rowCount();

              if ($numrows > 0) {
                while ($row = $query->fetch()) {
                  $id = $row['id'];
                  $title = $row['product_name'];
                  $image = $row['product_image'];
                  $prod_level = $row['level'] ?? '';
              ?>
                  <div class="book-card border-0 shadow-sm">
                    <a href="description_page?id=<?php echo $id; ?>" class="book-image-wrapper">
                      <img src="<?php echo (!empty($image) ? "./unibooks_download/" . $image : 'assets/Images/noimage.jpg'); ?>" alt="<?php echo $title; ?>" class="book-image">
                    </a>
                    <div class="book-info">
                      <div class="book-title text-dark"><?php echo $title; ?></div>
                      <div class="d-flex justify-content-between align-items-center mt-2">
                        <span class="badge bg-light text-dark mb-0"><?php echo $prod_level; ?>L</span>
                        <small class="text-primary fw-bold">Read</small>
                      </div>
                    </div>
                  </div>
              <?php
                }
              } else {
                echo '<div class="col-12 text-center py-5 text-muted">
                                <i class="fa fa-folder-open fa-3x mb-3 text-light"></i>
                                <p>No specific recommendations found.</p>
                              </div>';
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include "footer.php" ?>
  </div>

  <?php include "bottom_nav_app.php"; ?>
  <?php include "plugin.php" ?>

  <!-- Core JS Files -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="assets/js/material-dashboard.min.js?v=3.0.4"></script>
</body>

</html>