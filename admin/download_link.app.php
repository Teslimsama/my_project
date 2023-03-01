<?php
    include 'session.php';
    // $filename = "../unibooks_download/";
    // if (isset($_GET['file'])) {
    //    $filename .= $_GET['file'];
    // }

    // if (file_exists($filename)) {
    //     $mime_type = mime_content_type($filename);
        
    //     header("Content-type: " . $mime_type);
    //     header("Content-Disposition: attachment; filename=$filename ");

    //     readfile("../book_download/" . $filename);
    // }else{
    //     header("location:../content");
    // }


// Check if file ID is specified in URL query string
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve file details from database
    $sql = "SELECT * FROM producttb WHERE id = ?";
    $stmt = $conn->prepare($sql);
    // $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->fetch();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $filename = $row['product_name'];
        $filepath = "../book_download/" . $filename;
        $customerid = $user['id'];
        $time = $row['filesize'];

        // Record file download in database
        $sql = "INSERT INTO downloads (book, customerid, timestamp) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $filename, $customerid, $time);
        $stmt->execute();

        // Download file
        header("Content-type: application/octet-stream");
        header("Content-disposition: attachment; filename=" . $filename);
        header("Content-length: " . filesize($filepath));
        readfile($filepath);
        exit;
    } else {
        echo "File not found.";
    }
} else {
    echo "File ID not specified.";
}

// Close database connection
$pdo->close();
?>
