<?php
include 'database.php';
$stmt = $conn->query("SELECT id, productlink FROM producttb WHERE productlink LIKE '%.pdf' LIMIT 5");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $pdfPath = __DIR__ . '/unibooks_download/' . $row['productlink'];
    echo "ID: " . $row['id'] . "\n";
    echo "Path: " . $pdfPath . "\n";
    echo "Exists: " . (file_exists($pdfPath) ? "YES" : "NO") . "\n";
    echo "-------------------\n";
}
