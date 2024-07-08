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
        $pdfPath =
        __DIR__ . '/unibooks_download/' .$row['productlink']; // Make sure this field contains the correct path to the PDF file
        $pdf = new Pdf($pdfPath);

        $totalPages = $pdf->getNumberOfPages();
        $images = [];

        for ($i = 1; $i <= $totalPages; $i++) {
            $image = $pdf->setPage($i)->saveImage("temp/{$row['id']}_page_{$i}.jpg");
            $images[] = "temp/{$row['id']}_page_{$i}.jpg";
        }
    } else {
        echo "PDF not found.";
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