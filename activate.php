<?php include 'session.php'; ?>
<?php
$output = '';
if (!isset($_GET['code']) or !isset($_GET['user'])) {
    $output .= '
			<div class="alert alert-danger">
                <h4><i class="icon fa fa-warning"></i> Error!</h4>
                Code to activate account not found.
            </div>
            <h4>You may <a href="signup">Signup</a> or back to <a href="index">Homepage</a>.</h4>
		';
} else {
    $conn = $pdo->open();

    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM unibooker WHERE activate_code=:code AND id=:id");
    $stmt->execute(['code' => $_GET['code'], 'id' => $_GET['user']]);
    $row = $stmt->fetch();

    if ($row['numrows'] > 0) {
        if ($row['status']) {
            $output .= '
					<div class="alert alert-danger">
		                <h4><i class="icon fa fa-warning"></i> Error!</h4>
		                Account already activated.
		            </div>
		            <h4>You may <a href="signin">Login</a> or back to <a href="index">Homepage</a>.</h4>
				';
        } else {
            try {
                $stmt = $conn->prepare("UPDATE unibooker SET status=:status WHERE id=:id");
                $stmt->execute(['status' => 1, 'id' => $row['id']]);
                $output .= '
						<div class="alert alert-success">
			                <h4><i class="icon fa fa-check"></i> Success!</h4>
			                Account activated - Email: <b>' . $row['email'] . '</b>.
			            </div>
			            <h4>You may <a href="signin">Login</a> or back to <a href="index">Homepage</a>.</h4>
					';
            } catch (PDOException $e) {
                $output .= '
						<div class="alert alert-danger">
			                <h4><i class="icon fa fa-warning"></i> Error!</h4>
			                ' . $e->getMessage() . '
			            </div>
			            <h4>You may <a href="signup">Signup</a> or back to <a href="index">Homepage</a>.</h4>
					';
            }
        }
    } else {
        $output .= '
				<div class="alert alert-danger">
	                <h4><i class="icon fa fa-warning"></i> Error!</h4>
	                Cannot activate account. Wrong code.
	            </div>
	            <h4>You may <a href="signup">Signup</a> or back to <a href="index">Homepage</a>.</h4>
			';
    }

    $pdo->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "meta.php" ?>
    <title>
        My Books || Unibooks
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
            <div class="col-4"></div>
            <div class="col-4 mt-5">
                <div class="card dets ">
                    <!-- <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Lists of Uploaded Books</h6>
                        </div>
                    </div> -->
                    <div class="card-body px-0 pb-2">
                        <div class=" row col-12 ps-3">

                            <div class="col-lg-12 col-sm-12">
                                <?php echo $output; ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-4"></div>
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

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="assets/js/material-dashboard.min.js?v=3.0.4"></script>
</body>

</html>