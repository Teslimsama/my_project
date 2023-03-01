<ul class="navbar-nav  justify-content-end">
    <li class="nav-item d-flex align-items-center">
        <?php
        $acctype = $_SESSION['id'];

        if ($acctype) {

            echo "
          <a href='./profilepage' class='nav-link text-body font-weight-bold px-0'>
               <i class='fa fa-user me-sm-1 '></i>
        
           </a>
              ";
        } else {
            echo "
               <a href='./Signin' class='nav-link text-body font-weight-bold px-0'>
               
               <span class='d-sm-inline d-none'>Sign In</span>
           </a>
              ";
        }
        ?>
    </li>
    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
            </div>
        </a>
    </li>
    <li class="nav-item px-3 d-flex align-items-center">
        <a href="javascript:;" class="nav-link text-body p-0">
            <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
        </a>
    </li>
    <li class="nav-item dropdown pe-2 d-flex align-items-center">
        <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            <?php
            $query = $conn->prepare("SELECT * from `notifications` where `status` = 'unread' order by `date` DESC");
            $query->execute();
            $res = $query->rowCount();
            if ($res > 0) {
            ?> <span class="position-absolute top-45 start-80 translate-middle badge rounded-pill bg-dark"><?php echo $res; ?> </span>

            <?php
            }
            ?>
            <i class="fa fa-bell cursor-pointer"></i>
        </a>
        <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
            <?php
            $stmt = $conn->prepare("SELECT * from `notifications` where `status` = 'unread' order by `date` DESC");
            $stmt->execute();
            $resu = $stmt->fetchAll();
            if ($res > 0) {
                foreach ($resu as $i) {
            ?>


                    <?php
                    $link = $i['id'];
                    $alert = "
                        <li class='mb-2'>
    <a class='dropdown-item border-radius-md' href='view?id=" . $link . "'>
        <div class='d-flex py-1'>
            <div class='my-auto'>
                <img src='../assets/img/team-2.jpg' class='avatar avatar-sm  me-3 'alt='" . $i['date'] . "'>
            </div>
            <div class='d-flex flex-column justify-content-center'>
                <h6 class='text-sm font-weight-normal mb-1'>
                    ";

                    $alert .= htmlentities($i['message']);
                    $alert .= "<span class='font-weight-bold'> by " . $i['name'] . "</span> 
                </h6>
                <p class='text-xs text-secondary mb-0'>
                    <i class='fa fa-clock me-1'></i>
     ";
                    $alert .= "
                    " . $i['date'] . "
                </p>
            </div>
        </div>
    </a>
</li>";
                    if ($i['type'] == 'comment') {
                        echo $alert;
                        // print_r($resu) ;

                    }
                    ?>


            <?php
                }
            } else {
                echo "No notifications yet.";
            }
            ?>
            <li class="mb-2">
                <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                        <div class="my-auto">
                            <img src="" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="text-sm font-weight-normal mb-1">
                                <span class="font-weight-bold">New album</span> by Travis Scott
                            </h6>
                            <p class="text-xs text-secondary mb-0">
                                <i class="fa fa-clock me-1"></i>
                                1 day
                            </p>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                        <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                            <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>credit-card</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(453.000000, 454.000000)">
                                                <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                                                <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="text-sm font-weight-normal mb-1">
                                Payment successfully completed
                            </h6>
                            <p class="text-xs text-secondary mb-0">
                                <i class="fa fa-clock me-1"></i>
                                2 days
                            </p>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item px-3 d-flex align-items-center">
        <a href="logout" class="nav-link text-body p-0">
            <i class="material-icons opacity-10">logout</i>
        </a>
    </li>

</ul>