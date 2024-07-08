<?php include "session.php";
// Fetch monthly revenue data
$stmt = $conn->prepare("SELECT DATE_FORMAT(date, '%Y-%m') AS month, SUM(amount * quantity) AS total FROM payments WHERE status = 'success' GROUP BY month ORDER BY month ASC");
$stmt->execute();

$monthly_revenue = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $monthly_revenue[$row['month']] = $row['total'];
}

// Convert the data to JSON format
$monthly_revenue_json = json_encode($monthly_revenue);
// Fetch monthly revenue data
$stmt = $conn->prepare("SELECT DATE_FORMAT(date, '%Y-%m') AS month, COUNT(*) AS total FROM downloads GROUP BY month ORDER BY month ASC");
$stmt->execute();

$monthly_downloads = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $monthly_downloads[$row['month']] = $row['total'];
}

// Convert the data to JSON format
$monthly_downloads_json = json_encode($monthly_downloads);
?>
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
    <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="assets/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body class="with-welcome-text">
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php include 'navbar.php'; ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <?php include 'sidebar.php'; ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="home-tab">
                                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                                        </li>
                                    </ul>

                                </div>
                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="statistics-details d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <p class="statistics-title">Daily Revenue</p>
                                                        <?php

                                                        function number_format_short($n, $precision = 1)
                                                        {
                                                            if ($n < 900) {
                                                                // 0 - 900
                                                                $n_format = number_format($n, $precision);
                                                                $suffix = '';
                                                            } else if ($n < 900000) {
                                                                // 0.9k-850k
                                                                $n_format = number_format($n / 1000, $precision);
                                                                $suffix = 'K';
                                                            } else if ($n < 900000000) {
                                                                // 0.9m-850m
                                                                $n_format = number_format($n / 1000000, $precision);
                                                                $suffix = 'M';
                                                            } else if ($n < 900000000000) {
                                                                // 0.9b-850b
                                                                $n_format = number_format($n / 1000000000, $precision);
                                                                $suffix = 'B';
                                                            } else {
                                                                // 0.9t+
                                                                $n_format = number_format($n / 1000000000000, $precision);
                                                                $suffix = 'T';
                                                            }
                                                            // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
                                                            // Intentionally does not affect partials, eg "1.50" -> "1.50"
                                                            if ($precision > 0) {
                                                                $dotzero = '.' . str_repeat('0', $precision);
                                                                $n_format = str_replace($dotzero, '', $n_format);
                                                            }
                                                            return $n_format . $suffix;
                                                        }
                                                        $Date_time = date('Y-m-d');
                                                        $stmt = $conn->prepare("SELECT * FROM payments WHERE status = 'success' AND DATE(date) = '$Date_time';");
                                                        $stmt->execute();
                                                        $total = 0;
                                                        foreach ($stmt as $srow) {
                                                            $subtotal = $srow['amount'] * $srow['quantity'];
                                                            $total += $subtotal;
                                                        }
                                                        echo '<h3 class="rate-percentage">₦' . number_format_short($total, 2) . '</h4>';
                                                        ?>
                                                        <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>-0.5%</span></p>
                                                    </div>
                                                    <div>
                                                        <p class="statistics-title">Users</p>
                                                        <?php
                                                        $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM unibooker WHERE type =0");
                                                        $stmt->execute();
                                                        $urow =  $stmt->fetch();

                                                        echo '<h3 class="rate-percentage"> ' . $urow['numrows'] . "</h3>";
                                                        ?>
                                                        <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+0.1%</span></p>
                                                    </div>
                                                    <div>
                                                        <p class="statistics-title">Total Revenue</p>
                                                        <?php
                                                        $stmt = $conn->prepare("SELECT * FROM payments WHERE status = 'success'");
                                                        $stmt->execute();
                                                        $total = 0;
                                                        foreach ($stmt as $srow) {
                                                            $subtotal = $srow['amount'] * $srow['quantity'];
                                                            $total += $subtotal;
                                                        }
                                                        echo '<h3 class="rate-percentage">₦' . number_format_short($total, 2) . "</h3>";
                                                        ?>
                                                        <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p>
                                                    </div>
                                                    <div class="d-none d-md-block">
                                                        <p class="statistics-title">Uploads Commissions</p>
                                                        <h3 class="rate-percentage"></h3>
                                                        <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span></p>
                                                    </div>
                                                    <div class="d-none d-md-block">
                                                        <p class="statistics-title">Products</p>
                                                        <?php
                                                        $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM producttb");
                                                        $stmt->execute();
                                                        $urow =  $stmt->fetch();

                                                        echo '<h3 class="rate-percentage"' . $urow['numrows'] . "</h3>";
                                                        ?>
                                                        <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8 d-flex flex-column">
                                                <div class="row flex-grow">
                                                    <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                                                        <div class="card card-rounded">
                                                            <div class="card-body">
                                                                <div class="d-sm-flex justify-content-between align-items-start">
                                                                    <div>
                                                                        <h4 class="card-title card-title-dash">Products Purchase</h4>
                                                                        <h5 class="card-subtitle card-subtitle-dash">Products bought monthly</h5>
                                                                    </div>
                                                                    <div id="performanceLine-legend"></div>
                                                                </div>
                                                                <div class="chartjs-wrapper mt-4">
                                                                    <canvas id="performanceLine" width=""></canvas>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 d-flex flex-column">
                                                <div class="row flex-grow">
                                                    <div class="col-md-12 col-lg-12 grid-margin stretch-card">
                                                        <div class="card card-rounded">
                                                            <div class="card-body card-rounded">
                                                                <h4 class="card-title  card-title-dash">Recent Events</h4>
                                                                <div class="list align-items-center border-bottom py-2">
                                                                    <div class="wrapper w-100">
                                                                        <p class="mb-2 fw-medium"> Change in Directors </p>
                                                                        <div class="d-flex justify-content-between align-items-center">
                                                                            <div class="d-flex align-items-center">
                                                                                <i class="mdi mdi-calendar text-muted me-1"></i>
                                                                                <p class="mb-0 text-small text-muted">Mar 14, 2019</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- add something here -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8 d-flex flex-column">
                                                <div class="row flex-grow">
                                                    <div class="col-12 grid-margin stretch-card">
                                                        <div class="card card-rounded">
                                                            <div class="card-body">
                                                                <div class="d-sm-flex justify-content-between align-items-start">
                                                                    <div>
                                                                        <h4 class="card-title card-title-dash">Products Downloaded</h4>
                                                                        <p class="card-subtitle card-subtitle-dash">Products downloads monthly</p>
                                                                    </div>
                                                                </div>
                                                                <div class="d-sm-flex align-items-center mt-1 justify-content-between">
                                                                    <div class="d-sm-flex align-items-center mt-4 justify-content-between">
                                                                        <?php
                                        $stmt = $conn->prepare("SELECT COUNT(*) AS total_downloads FROM downloads;");
                                        $stmt->execute();
                                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $total_downloads = $row['total_downloads'];

                                        echo '<h2 class="me-2 fw-bold">' . number_format_short($total_downloads, 2) . '</h2>';

                                                                        ?>
                                                                        <h4 class="text-success">(+1.37%)</h4>
                                                                    </div>
                                                                    <div class="me-3">
                                                                        <div id="marketingOverview-legend"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="chartjs-bar-wrapper mt-3">
                                                                    <canvas id="marketingOverview"></canvas>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row flex-grow">
                                                    <div class="col-12 grid-margin stretch-card">
                                                        <div class="card card-rounded">
                                                            <div class="card-body">
                                                                <div class="d-sm-flex justify-content-between align-items-start">
                                                                    <div>
                                                                        <h4 class="card-title card-title-dash">Pending Requests</h4>
                                                                        <p class="card-subtitle card-subtitle-dash">You have 50+ new requests</p>
                                                                    </div>
                                                                    <div>
                                                                        <button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i class="mdi mdi-account-plus"></i>Add new member</button>
                                                                    </div>
                                                                </div>
                                                                <div class="table-responsive  mt-1">
                                                                    <table class="table select-table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Book</th>
                                                                                <th>User</th>
                                                                                <th>Amount</th>
                                                                                <th>Status</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="d-flex ">
                                                                                        <img src="assets/images/faces/face1.jpg" alt="">
                                                                                        <div>
                                                                                            <h6>Brandon Washington</h6>
                                                                                            <p>Head admin</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <h6>Company name 1</h6>
                                                                                    <p>company type</p>
                                                                                </td>
                                                                                <td>
                                                                                    <div>
                                                                                        <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                                                                            <p class="text-success">79%</p>
                                                                                            <p>85/162</p>
                                                                                        </div>
                                                                                        <div class="progress progress-md">
                                                                                            <div class="progress-bar bg-success" role="progressbar" style="width: 85%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="badge badge-opacity-warning">In progress</div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-lg-4 d-flex flex-column">
                                                <div class="row flex-grow">
                                                    <div class="col-12 grid-margin stretch-card">
                                                        <div class="card card-rounded">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                                                            <div>
                                                                                <h4 class="card-title card-title-dash">Top Performer</h4>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mt-3">
                                                                            <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                                                                <div class="d-flex">
                                                                                    <img class="img-sm rounded-10" src="assets/images/faces/face1.jpg" alt="profile">
                                                                                    <div class="wrapper ms-3">
                                                                                        <p class="ms-1 mb-1 fw-bold">Brandon Washington</p>
                                                                                        <small class="text-muted mb-0">162543</small>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="text-muted text-small"> 1h ago </div>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- content-wrapper ends -->
                    <!-- partial:partials/_footer.html -->

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
        <script src="assets/vendors/chart.js/chart.umd.js"></script>
        <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="assets/js/off-canvas.js"></script>
        <script src="assets/js/template.js"></script>
        <script src="assets/js/settings.js"></script>
        <script src="assets/js/hoverable-collapse.js"></script>
        <script src="assets/js/todolist.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
        <script src="assets/js/dashboard.js"></script>
        <!-- <script src="assets/js/Chart.roundedBarCharts.js"></script> -->
        <script>
            $(function() {
                // Get the monthly revenue data from PHP
                var monthlyRevenue = <?php echo $monthly_revenue_json; ?>;

                // Extract the months and revenue values for the chart
                var labels = Object.keys(monthlyRevenue);
                var data = Object.values(monthlyRevenue);

                if ($("#performanceLine").length) {
                    const ctx = document.getElementById('performanceLine');
                    var graphGradient = document.getElementById("performanceLine").getContext('2d');
                    var graphGradient2 = document.getElementById("performanceLine").getContext('2d');
                    var saleGradientBg = graphGradient.createLinearGradient(5, 0, 5, 100);
                    saleGradientBg.addColorStop(0, 'rgba(26, 115, 232, 0.18)');
                    saleGradientBg.addColorStop(1, 'rgba(26, 115, 232, 0.02)');
                    var saleGradientBg2 = graphGradient2.createLinearGradient(100, 0, 50, 150);
                    saleGradientBg2.addColorStop(0, 'rgba(0, 208, 255, 0.19)');
                    saleGradientBg2.addColorStop(1, 'rgba(0, 208, 255, 0.03)');

                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels, // Use the months as labels
                            datasets: [{
                                label: 'Monthly Revenue',
                                data: data, // Use the revenue values
                                backgroundColor: saleGradientBg,
                                borderColor: ['#1F3BB3'],
                                borderWidth: 1.5,
                                fill: true,
                                pointBorderWidth: 1,
                                pointRadius: 4,
                                pointHoverRadius: 2,
                                pointBackgroundColor: '#1F3BB3',
                                pointBorderColor: '#fff'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            elements: {
                                line: {
                                    tension: 0.4,
                                }
                            },
                            scales: {
                                y: {
                                    grid: {
                                        display: true,
                                        color: "#F0F0F0",
                                        drawBorder: false,
                                    },
                                    ticks: {
                                        beginAtZero: false,
                                        autoSkip: true,
                                        maxTicksLimit: 4,
                                        color: "#6B778C",
                                        font: {
                                            size: 10,
                                        }
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false,
                                        drawBorder: false,
                                    },
                                    ticks: {
                                        autoSkip: true,
                                        maxTicksLimit: 7,
                                        color: "#6B778C",
                                        font: {
                                            size: 10,
                                        }
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false,
                                }
                            }
                        }
                    });
                }
            });
            $(function() {
                // Get the monthly downloads data from PHP
                var monthlyDownloads = <?php echo $monthly_downloads_json; ?>;

                // Extract the months and download counts for the chart
                var labels = Object.keys(monthlyDownloads);
                var data = Object.values(monthlyDownloads);

                // Ensure the labels array has all months (JAN to DEC)
                var allMonths = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
                var fullData = new Array(12).fill(0);

                labels.forEach((month, index) => {
                    var monthIndex = allMonths.indexOf(month.toUpperCase());
                    if (monthIndex !== -1) {
                        fullData[monthIndex] = data[index];
                    }
                });

                if ($("#marketingOverview").length) {
                    const marketingOverviewCanvas = document.getElementById('marketingOverview');
                    new Chart(marketingOverviewCanvas, {
                        type: 'bar',
                        data: {
                            labels: allMonths,
                            datasets: [{
                                label: 'Downloads',
                                data: fullData,
                                backgroundColor: "#1F3BB3",
                                borderColor: ['#1F3BB3'],
                                borderWidth: 0,
                                barPercentage: 0.35,
                                fill: true
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    grid: {
                                        display: true,
                                        drawTicks: false,
                                        color: "#F0F0F0",
                                        zeroLineColor: '#F0F0F0',
                                    },
                                    ticks: {
                                        beginAtZero: true,
                                        autoSkip: true,
                                        maxTicksLimit: 4,
                                        color: "#6B778C",
                                        font: {
                                            size: 10,
                                        }
                                    }
                                },
                                x: {
                                    stacked: true,
                                    grid: {
                                        display: false,
                                        drawTicks: false,
                                    },
                                    ticks: {
                                        autoSkip: true,
                                        maxTicksLimit: 12,
                                        color: "#6B778C",
                                        font: {
                                            size: 10,
                                        }
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false,
                                }
                            }
                        }
                    });
                }
            });
        </script>
        <!-- End custom js for this page-->
</body>

</html>