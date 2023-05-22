<?php
include 'session.php';
$id = $_GET['id'];

// Get the file path from the database
$sql = "SELECT * FROM producttb WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);
$result = $stmt->fetch();
// print_r($result);
if ($result > 1) {
    // Get the file path and name
    $filename = $result['product_name'];
    $filebook = $result['productlink'];
    $filepath = "unibooks_download/" . $filebook;
    $id = $_GET['id'];

    // Check if the file exists
    if (file_exists($filepath)) {
        // Clear the output buffer
        ob_clean();
        $id = $_GET['id'];
        $customerid = $user['id'];

        $time = date('Y-m-d');
        // Record file download in database
        $sql = "INSERT INTO downloads (customerid,book_id,date) VALUES (:customerid, :book , :date)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['book' => $filename, 'customerid' => $customerid, 'date' => $time]);
        // Set the headers
        header("Content-type: " . finfo_file(finfo_open(FILEINFO_MIME_TYPE), $filepath));
        header("Content-disposition: attachment; filename=" . $filename);
        header("Content-length: " . filesize($filepath));

        // Read and output the file contents
        readfile($filepath);
        header("location:description_page.pro.php?id=" . $id);
        exit;
    } else {
        // File not found
        $_SESSION['error'] = "File not found.";
        header("location:description_page.pro.php?id=" . $id);
        exit;
    }
} else {
    // Invalid ID
    $_SESSION['error'] = "File not found.";
    header("location:description_page.pro.php?id=" . $id);
    exit;
}
