<?php
include "session.php";
require 'vendor/autoload.php';

use Spatie\PdfToImage\Pdf;

$images = [];
$error_msg = '';
$book_id = $_GET['id'] ?? null;
$book_title = 'PDF Preview';

if ($book_id) {
    $sql = "SELECT * FROM producttb WHERE id = :id";
    $statement = $conn->prepare($sql);
    $statement->execute([':id' => $book_id]);
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $book_title = $row['product_name'] ?? 'Book Preview';
        $pdfFile = trim($row['productlink']);
        $pdfPath = __DIR__ . DIRECTORY_SEPARATOR . 'unibooks_download' . DIRECTORY_SEPARATOR . $pdfFile;

        // Create temp directory if it doesn't exist
        if (!file_exists('temp')) {
            mkdir('temp', 0777, true);
        }

        if (file_exists($pdfPath) && !empty($pdfFile)) {
            try {
                $pdf = new Pdf($pdfPath);
                $totalPages = $pdf->getNumberOfPages();

                // Limit preview to first few pages for performance and security
                $previewLimit = min($totalPages, 5);

                for ($i = 1; $i <= $previewLimit; $i++) {
                    $tempImagePath = "temp/{$row['id']}_page_{$i}.jpg";
                    // Only regenerate if doesn't exist to save processing
                    if (!file_exists($tempImagePath)) {
                        $pdf->setPage($i)->saveImage($tempImagePath);
                    }
                    $images[] = $tempImagePath;
                }
            } catch (Exception $e) {
                $error_msg = "Error processing PDF: " . $e->getMessage();
            }
        } else {
            $error_msg = "PDF file not found. It may have been moved or deleted.";
        }
    } else {
        $error_msg = "Book record not found.";
    }
} else {
    $error_msg = "No book specified.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "meta.php" ?>
    <title>Preview: <?php echo htmlspecialchars($book_title); ?> || Unibooks</title>
    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/e9de02addb.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/app.css">
    <style>
        .pdf-page {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-bottom: 30px;
            border: 1px solid #e2e8f0;
            transition: transform 0.2s;
        }

        .pdf-page:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .preview-container {
            max-width: 800px;
            margin: 0 auto;
        }
    </style>
</head>

<body class="bg-light">
    <?php include "header_app.php"; ?>

    <main class="container py-5">
        <div class="preview-container">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h2 class="fw-bold text-dark mb-1">Preview</h2>
                    <p class="text-muted mb-0"><?php echo htmlspecialchars($book_title); ?></p>
                </div>
                <a href="description_page.php?id=<?php echo htmlspecialchars($book_id); ?>" class="btn btn-outline-primary rounded-pill px-4">
                    <i class="fa fa-arrow-left me-2"></i> Back to Details
                </a>
            </div>

            <?php if ($error_msg): ?>
                <div class="alert alert-danger text-white" role="alert">
                    <h5 class="text-white"><i class="fa fa-warning me-2"></i> Error</h5>
                    <?php echo htmlspecialchars($error_msg); ?>
                </div>
                <div class="text-center mt-4">
                    <a href="index" class="btn btn-light rounded-pill">Go Home</a>
                </div>
            <?php else: ?>
                <div class="pdf-preview text-center">
                    <?php foreach ($images as $index => $image) : ?>
                        <div class="position-relative">
                            <img src="<?php echo htmlspecialchars($image); ?>" class="img-fluid pdf-page bg-white" alt="Page <?php echo $index + 1; ?>">
                            <div class="mb-5 text-muted small">Page <?php echo $index + 1; ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="card bg-white border-0 shadow-sm p-4 text-center mt-4 rounded-4">
                    <h5 class="fw-bold">Enjoying the preview?</h5>
                    <p class="text-muted">Get the full book to continue reading.</p>
                    <div>
                        <a href="description_page.php?id=<?php echo htmlspecialchars($book_id); ?>" class="btn btn-primary rounded-pill px-5 shadow-primary">
                            Get Full Book
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php include "footer.php" ?>
    </main>

    <?php include "bottom_nav_app.php"; ?>
    <?php include "plugin.php" ?>

    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
</body>

</html>