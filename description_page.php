<?php
include "session.php";
require 'vendor/autoload.php';

use Spatie\PdfToImage\Pdf;

if (isset($_GET['id'])) {
  // Use prepared statement to prevent SQL injection
  $sql = "SELECT * FROM producttb WHERE id = :id OR productlink = :id";
  $statement = $conn->prepare($sql);
  $statement->execute([':id' => $_GET['id']]);
  $row = $statement->fetch(PDO::FETCH_ASSOC);

  if ($row) {
    $productID = $row['product_name'];
    $query = "SELECT * FROM producttb p
                  LEFT JOIN search s ON p.product_name = s.title
                  WHERE s.title = :product_name
                  LIMIT 1";
    $statement = $conn->prepare($query);
    $statement->bindParam(':product_name', $productID, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetch(PDO::FETCH_ASSOC);
  } else {
    // Redirect if no result found
    header("Location: index");
    exit;
  }
} else {
  header("Location: index");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Apple Touch Icons -->
  <link rel="apple-touch-icon-precomposed" sizes="57x57" href="assets/favicomatic/apple-touch-icon-57x57.png" />
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/favicomatic/apple-touch-icon-114x114.png" />
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/favicomatic/apple-touch-icon-72x72.png" />
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/favicomatic/apple-touch-icon-144x144.png" />
  <link rel="apple-touch-icon-precomposed" sizes="60x60" href="assets/favicomatic/apple-touch-icon-60x60.png" />
  <link rel="apple-touch-icon-precomposed" sizes="120x120" href="assets/favicomatic/apple-touch-icon-120x120.png" />
  <link rel="apple-touch-icon-precomposed" sizes="76x76" href="assets/favicomatic/apple-touch-icon-76x76.png" />
  <link rel="apple-touch-icon-precomposed" sizes="152x152" href="assets/favicomatic/apple-touch-icon-152x152.png" />
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="assets/favicomatic/favicon-196x196.png" sizes="196x196" />
  <link rel="icon" type="image/png" href="assets/favicomatic/favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/png" href="assets/favicomatic/favicon-32x32.png" sizes="32x32" />
  <link rel="icon" type="image/png" href="assets/favicomatic/favicon-16x16.png" sizes="16x16" />
  <link rel="icon" type="image/png" href="assets/favicomatic/favicon-128.png" sizes="128x128" />
  <!-- MS Application -->
  <meta name="application-name" content="Unibooks.com.ng" />
  <meta name="msapplication-TileColor" content="#FFFFFF" />
  <meta name="msapplication-TileImage" content="assets/favicomatic/mstile-144x144.png" />
  <meta name="msapplication-square70x70logo" content="assets/favicomatic/mstile-70x70.png" />
  <meta name="msapplication-square150x150logo" content="assets/favicomatic/mstile-150x150.png" />
  <meta name="msapplication-wide310x150logo" content="assets/favicomatic/mstile-310x150.png" />
  <meta name="msapplication-square310x310logo" content="assets/favicomatic/mstile-310x310.png" />
  <!-- Meta Description -->
  <meta name="description" content="<?php echo htmlspecialchars($row['description'] ?? ''); ?>">
  <meta name="keywords" content="book description, book details, book summary, book information, book metadata, book author, book title">
  <meta name="author" content="Unibooks, Nigeria by Teslimsama">
  <!-- Meta Title -->
  <title><?php echo htmlspecialchars($row['product_name'] ?? ''); ?> - <?php echo htmlspecialchars($row['description'] ?? ''); ?> | Unibooks, Nigeria</title>
  <!-- Open Graph Meta Tags -->
  <meta property="og:title" content="<?php echo htmlspecialchars($row['product_name'] ?? ''); ?> - <?php echo htmlspecialchars($row['description'] ?? ''); ?> | Unibooks, Nigeria" />
  <meta property="og:description" content="<?php echo htmlspecialchars($row['description'] ?? ''); ?>" />
  <meta property="og:image" content="https://unibooks.com.ng/<?php echo htmlspecialchars($row['product_image']); ?>" />
  <meta property="og:url" content="https://unibooks.com.ng/description_page?id=<?php echo htmlspecialchars($row['id'] ?? ''); ?>&book=<?php echo htmlspecialchars($row['productlink'] ?? ''); ?>" />
  <meta property="og:type" content="article" />
  <meta property="og:site_name" content="Unibooks, Nigeria" />
  <meta property="og:locale" content="en_US" />
  <!-- Twitter Card Meta Tags -->
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:title" content="<?php echo htmlspecialchars($row['product_name'] ?? ''); ?> - <?php echo htmlspecialchars($row['description'] ?? ''); ?> | Unibooks, Nigeria" />
  <meta name="twitter:description" content="<?php echo htmlspecialchars($row['description'] ?? ''); ?>" />
  <meta name="twitter:image" content="https://unibooks.com.ng/<?php echo htmlspecialchars($row['product_image']); ?>" />

  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/e9de02addb.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/profile.css">
  <link rel="stylesheet" href="assets/css/app.css">
</head>

<body class="bg-light">
  <?php include "header_app.php"; ?>

  <main class="container-fluid pb-5">
    <div class="container-fluid py-4">
      <div class="row min-vh-80">
        <div class="col-12">
          <div class="card mt-4">
            <div class="card-header p-0 position-relative mt-4 mx-3 z-index-2">
              <div class="pic bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3"><?php echo htmlspecialchars($row['product_name']); ?></h6>
              </div>
            </div>
            <div class="card-body row px-5">
              <div class="msg">
                <?php echo ErrorMessage();
                echo SuccessMessage(); ?>
              </div>
              <div class=" row col-12">
                <div class="col-lg-3 col-sm-6">
                  <a href="download_link.app.php?id=<?php echo htmlspecialchars($row['id']); ?>" name="download"><button class="btn btn-dark">Download <i class="material-icons ms-1 opacity-10">download</i></button>

                  </a>
                </div>
                <div class=" col-lg-3 col-sm-6">
                  <a href="pdf_preview.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-info" name="preview">
                    Preview PDF <i class="material-icons ms-1 opacity-10">picture_as_pdf</i>
                  </a>
                </div>
              </div>
              <div class="col-12">
                <?php echo htmlspecialchars($result['description']); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include "footer.php" ?>
  </main>

  <?php include "bottom_nav_app.php"; ?>

  <?php include "plugin.php" ?>

  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="assets/js/material-dashboard.min.js?v=3.0.4"></script>
</body>

</html>