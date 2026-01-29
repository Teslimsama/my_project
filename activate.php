<?php include 'session.php'; ?>
<?php
$output = '';
if (!isset($_GET['code']) or !isset($_GET['user'])) {
    $output .= '
            <div class="alert alert-danger text-white" role="alert">
                <h5 class="text-white"><i class="fa fa-warning me-2"></i> Error!</h5>
                Code to activate account not found.
            </div>';
} else {
    $conn = $pdo->open();

    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM unibooker WHERE activate_code=:code AND id=:id");
    $stmt->execute(['code' => $_GET['code'], 'id' => $_GET['user']]);
    $row = $stmt->fetch();

    if ($row['numrows'] > 0) {
        if ($row['status']) {
            $output .= '
                    <div class="alert alert-info text-white" role="alert">
                        <h5 class="text-white"><i class="fa fa-info-circle me-2"></i> Notice</h5>
                        Account is already activated.
                    </div>';
        } else {
            try {
                $stmt = $conn->prepare("UPDATE unibooker SET status=:status WHERE id=:id");
                $stmt->execute(['status' => 1, 'id' => $row['id']]);
                $output .= '
                        <div class="alert alert-success text-white" role="alert">
                            <h5 class="text-white"><i class="fa fa-check-circle me-2"></i> Success!</h5>
                            Account activated successfully for <b>' . $row['email'] . '</b>.
                        </div>';
            } catch (PDOException $e) {
                $output .= '
                        <div class="alert alert-danger text-white" role="alert">
                            <h5 class="text-white"><i class="fa fa-warning me-2"></i> Error!</h5>
                            ' . $e->getMessage() . '
                        </div>';
            }
        }
    } else {
        $output .= '
                <div class="alert alert-danger text-white" role="alert">
                    <h5 class="text-white"><i class="fa fa-warning me-2"></i> Error!</h5>
                    Invalid activation code or user not found.
                </div>';
    }

    $pdo->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "meta.php" ?>
    <title>Account Activation || Unibooks</title>
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
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body class="bg-light">
    <?php include "header_app.php"; ?>

    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="auth-card text-center">
                    <div class="mb-4">
                        <img src="assets/Images/unibooks copy.png" alt="Unibooks" height="60">
                    </div>

                    <h3 class="fw-bold mb-4">Account Activation</h3>

                    <div class="my-4">
                        <?php echo $output; ?>
                    </div>

                    <?php if (strpos($output, 'alert-success') !== false): ?>
                        <a href="Signin" class="btn btn-primary rounded-pill px-5 py-3 shadow-primary fw-bold">Proceed to Login</a>
                    <?php else: ?>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="Signup" class="btn btn-primary rounded-pill px-4">Sign Up</a>
                            <a href="index" class="btn btn-light rounded-pill px-4">Home</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php include "footer.php" ?>
    </main>

    <?php include "bottom_nav_app.php"; ?>

    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
</body>

</html>