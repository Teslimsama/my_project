<?php include "session.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Star Admin2 </title>
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
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php include 'navbar.php'; ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      <?php include 'sidebar.php'; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="container-fluid px-2 px-md-4">
            <div class="container-fluid px-2 px-md-4">
              <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../Images/pexels-engin-akyurt-2943603.jpg');">
                <span class="mask  bg-gradient-primary  opacity-6"></span>
              </div>
              <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="row gx-4 mb-2">
                  <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                      <img src="../images/pexels-joão-jesus-1080213.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                    </div>
                  </div>
                  <div class="col-auto my-auto">
                    <div class="h-100">
                      <h5 class="mb-1">
                        <?php echo $admin['firstname'] . ' ' . $admin['lastname']; ?>
                      </h5>
                      <p class="mb-0 font-weight-normal text-sm">
                        Student
                      </p>
                    </div>
                  </div>

                </div>
                <div class="col-12 col-xl-4">
                  <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                      <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                          <h6 class="mb-0">Profile Information</h6>
                        </div>
                        <div class="col-md-4 text-end">
                          <a href="update_details">
                            <i class="fa fa-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="card-body p-3">

                      <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; <?php echo $admin['firstname'] . ' ' . $admin['lastname']; ?>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong> &nbsp; <?php echo $admin['phone']; ?></li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; <?php echo $admin['email']; ?></li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">University:</strong> &nbsp; <?php echo $admin['school']; ?></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-12 mt-4">
                  <div class="mb-5 ps-3">
                    <h6 class="mb-1">Projects</h6>
                    <p class="text-sm">Architects design houses</p>
                  </div>
                  <div class="row">
                    <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                      <div class="card card-blog card-plain">
                        <div class="card-header p-0 mt-n4 mx-3">
                          <a class="d-block shadow-xl border-radius-xl">
                            <img src="../../assets/img/home-decor-1.jpg" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                          </a>
                        </div>
                        <div class="card-body p-3">
                          <p class="mb-0 text-sm">Project #2</p>
                          <a href="javascript:;">
                            <h5>
                              Modern
                            </h5>
                          </a>
                          <p class="mb-4 text-sm">
                            As Uber works through a huge amount of internal management turmoil.
                          </p>
                          <div class="d-flex align-items-center justify-content-between">
                            <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                            <div class="avatar-group mt-2">
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
                                <img alt="Image placeholder" src="../../assets/img/team-1.jpg">
                              </a>
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Milly">
                                <img alt="Image placeholder" src="../../assets/img/team-2.jpg">
                              </a>
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nick Daniel">
                                <img alt="Image placeholder" src="../../assets/img/team-3.jpg">
                              </a>
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Peterson">
                                <img alt="Image placeholder" src="../../assets/img/team-4.jpg">
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                      <div class="card card-blog card-plain">
                        <div class="card-header p-0 mt-n4 mx-3">
                          <a class="d-block shadow-xl border-radius-xl">
                            <img src="../../assets/img/home-decor-2.jpg" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                          </a>
                        </div>
                        <div class="card-body p-3">
                          <p class="mb-0 text-sm">Project #1</p>
                          <a href="javascript:;">
                            <h5>
                              Scandinavian
                            </h5>
                          </a>
                          <p class="mb-4 text-sm">
                            Music is something that every person has his or her own specific opinion about.
                          </p>
                          <div class="d-flex align-items-center justify-content-between">
                            <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                            <div class="avatar-group mt-2">
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nick Daniel">
                                <img alt="Image placeholder" src="../../assets/img/team-3.jpg">
                              </a>
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Peterson">
                                <img alt="Image placeholder" src="../../assets/img/team-4.jpg">
                              </a>
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
                                <img alt="Image placeholder" src="../../assets/img/team-1.jpg">
                              </a>
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Milly">
                                <img alt="Image placeholder" src="../../assets/img/team-2.jpg">
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                      <div class="card card-blog card-plain">
                        <div class="card-header p-0 mt-n4 mx-3">
                          <a class="d-block shadow-xl border-radius-xl">
                            <img src="../../assets/img/home-decor-3.jpg" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                          </a>
                        </div>
                        <div class="card-body p-3">
                          <p class="mb-0 text-sm">Project #3</p>
                          <a href="javascript:;">
                            <h5>
                              Minimalist
                            </h5>
                          </a>
                          <p class="mb-4 text-sm">
                            Different people have different taste, and various types of music.
                          </p>
                          <div class="d-flex align-items-center justify-content-between">
                            <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                            <div class="avatar-group mt-2">
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Peterson">
                                <img alt="Image placeholder" src="../../assets/img/team-4.jpg">
                              </a>
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nick Daniel">
                                <img alt="Image placeholder" src="../../assets/img/team-3.jpg">
                              </a>
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Milly">
                                <img alt="Image placeholder" src="../../assets/img/team-2.jpg">
                              </a>
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
                                <img alt="Image placeholder" src="../../assets/img/team-1.jpg">
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                      <div class="card card-blog card-plain">
                        <div class="card-header p-0 mt-n4 mx-3">
                          <a class="d-block shadow-xl border-radius-xl">
                            <img src="https://images.unsplash.com/photo-1606744824163-985d376605aa?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                          </a>
                        </div>
                        <div class="card-body p-3">
                          <p class="mb-0 text-sm">Project #4</p>
                          <a href="javascript:;">
                            <h5>
                              Gothic
                            </h5>
                          </a>
                          <p class="mb-4 text-sm">
                            Why would anyone pick blue over pink? Pink is obviously a better color.
                          </p>
                          <div class="d-flex align-items-center justify-content-between">
                            <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                            <div class="avatar-group mt-2">
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Peterson">
                                <img alt="Image placeholder" src="../../assets/img/team-4.jpg">
                              </a>
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nick Daniel">
                                <img alt="Image placeholder" src="../../assets/img/team-3.jpg">
                              </a>
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Milly">
                                <img alt="Image placeholder" src="../../assets/img/team-2.jpg">
                              </a>
                              <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
                                <img alt="Image placeholder" src="../../assets/img/team-1.jpg">
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
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
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <!-- End custom js for this page-->
</body>

</html>