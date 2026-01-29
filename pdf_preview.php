<?php
include "session.php";
require 'vendor/autoload.php';

use Spatie\PdfToImage\Pdf;

if (isset($_GET['id'])) {
    $sql = "SELECT * FROM producttb WHERE id = :id";
    $statement = $conn->prepare($sql);
    $statement->execute([':id' => $_GET['id']]);
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    if ($row) {
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
                $images = [];

                // Limit preview to first few pages for performance and security
                $previewLimit = min($totalPages, 5);

                for ($i = 1; $i <= $previewLimit; $i++) {
                    $tempImagePath = "temp/{$row['id']}_page_{$i}.jpg";
                    $pdf->setPage($i)->saveImage($tempImagePath);
                    $images[] = $tempImagePath;
                }
            } catch (Exception $e) {
                $error_msg = "Error processing PDF: " . $e->getMessage();
            }
        } else {
            $error_msg = "PDF file not found at: " . $pdfPath;
        }
    } else {
        $error_msg = "Book record not found in database.";
    }

    if (isset($error_msg)) {
        echo "<div class='alert alert-danger'>$error_msg</div>";
        echo "<a href='description_page.php?id=" . htmlspecialchars($_GET['id']) . "' class='btn btn-primary'>Back</a>";
        exit;
    }
} else {
    echo "No PDF specified.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Preview</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1>PDF Preview</h1>
        <div class="pdf-preview">
            <?php foreach ($images as $image) : ?>
                <img src="<?php echo htmlspecialchars($image); ?>" class="img-fluid" alt="PDF Page">
            <?php endforeach; ?>
        </div>
        <a href="description_page.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-primary mt-3">Back to Description</a>
    </div>
</body>

</html>