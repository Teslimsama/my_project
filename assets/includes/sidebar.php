  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
      <div class="sidenav-header">
          <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
          <a class="navbar-brand m-0" href="about_us" target="_blank">
              <img src="Images/unibooks copy.png" class="navbar-brand-img h-100" alt="main_logo">
              <span class="ms-1 font-weight-bold text-white">Unibooks</span>
          </a>
      </div>
      <hr class="horizontal light mt-0 mb-2">
      <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
          <?php
            if (isset($_SESSION['firstname'])) {

                echo "
                <ul class='navbar-nav'>
              <li class='nav-item'>
                  <a class='nav-link text-white ' href='./content'>
                      <div class='text-white text-center me-2 d-flex align-items-center justify-content-center'>
                          <i class='material-icons opacity-10'>dashboard</i>
                      </div>
                      <span class='nav-link-text ms-1'>Dashboard</span>
                  </a>
              </li>
              <li class='nav-item'>
                  <a class='nav-link text-white ' href='./downloads'>
                      <div class='text-white text-center me-2 d-flex align-items-center justify-content-center'>
                          <i class='material-icons opacity-10'>download</i>
                      </div>
                      <span class='nav-link-text ms-1'>Downloads</span>
                  </a>
              </li>
              <li class='nav-item'>
                  <a class='nav-link text-white ' href='./payments'>
                      <div class='text-white text-center me-2 d-flex align-items-center justify-content-center'>
                          <i class='material-icons opacity-10'>receipt_long</i>
                      </div>
                      <span class='nav-link-text ms-1'>Payments</span>
                  </a>
              </li>

              
              <li class='nav-item'>
                  <a class='nav-link text-white ' href='./profilepage.php'>
                      <div class='text-white text-center me-2 d-flex align-items-center justify-content-center'>
                          <i class='material-icons opacity-10'>person</i>
                      </div>
                      <span class='nav-link-text ms-1'>Profile</span>
                  </a>
              </li>
              <li class='nav-item'>
                  <a class='nav-link text-white ' href='./logout'>
                      <div class='text-white text-center me-2 d-flex align-items-center justify-content-center'>
                          <i class='fa-solid fa-arrow-right-from-bracket opacity-10'></i>
                      </div>
                      <span class='nav-link-text ms-1'>Log Out</span>
                  </a>
              </li> 
              <li class='nav-item'>
                  <a class='nav-link text-white ' href='./project'>
                      <div class='text-white text-center me-2 d-flex align-items-center justify-content-center'>
                          <i class='fa-duotone fa-square-kanban opacity-10'>book</i>
                      </div>
                      <span class='nav-link-text ms-1'>Project</span>
                  </a>
              </li>
              <li class='nav-item mt-3'>
                  <h6 class='ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8'>Coming Soon...</h6>
              </li>
              <li class='nav-item'>
                  <a class='nav-link text-white ' href='./assignments'>
                      <div class='text-white text-center me-2 d-flex align-items-center justify-content-center'>
                          <i class='material-icons opacity-10'>assignment</i>
                      </div>
                      <span class='nav-link-text ms-1'>Assignment</span>
                  </a>
              </li>
             
          </ul>
              ";
            } else {
                echo "
                <ul class='navbar-nav'>

     <li class='nav-item'>
         <a class='nav-link text-white ' href='./Signup'>
             <div class='text-white text-center me-2 d-flex align-items-center justify-content-center'>
                 <i class='fa-solid fa-user-plus opacity-10'></i>
             </div>
             <span class='nav-link-text ms-1'>Sign Up</span>
         </a>
     </li>
     <li class='nav-item'>
         <a class='nav-link text-white ' href='./Signin'>
             <div class='text-white text-center me-2 d-flex align-items-center justify-content-center'>
                 <i class='fa-solid fa-arrow-right-to-bracket opacity-10'></i>
             </div>
             <span class='nav-link-text ms-1'>Signin</span>
         </a>
     </li>

     <li class='nav-item'>
         <a class='nav-link text-white ' href='./social'>
             <div class='text-white text-center me-2 d-flex align-items-center justify-content-center'>
                 <i class='fa-solid fa-hashtag opacity-10'></i>
             </div>
             <span class='nav-link-text ms-1'>Social Media</span>
         </a>
     </li>
 </ul>
              ";
            }
            ?>
      </div>
      <div class="sidenav-footer position-absolute w-100 bottom-0 ">
          <div class="mx-3">
              <a class="btn bg-gradient-primary mt-4 w-100" href="#" type="button">be a unibooker</a>
          </div>
      </div>
  </aside>



  <!-- <li class="nav-item">
      <a class="nav-link text-white " href="./notifications">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">notifications</i>
          </div>
          <span class="nav-link-text ms-1">Notifications</span>
          <?php
            $query = "SELECT * from `notifications` where `status` = 'unread' order by `date` DESC";
            if (count(fetchAll($query)) > 0) {
            ?> <span class="position-absolute top-45 start-80 translate-middle badge rounded-pill bg-dark"><?php echo count(fetchAll($query)); ?> </span>

          <?php
            }
            ?>

      </a>
  </li> -->