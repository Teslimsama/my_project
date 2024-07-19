<?php
include 'session.php';

// Specify the path to your files
$uploadDir = './unibooks_download/';

// Get the ID from the URL parameter
$id = $_GET['id'];

if ($id) {
    // Prepare and execute the SQL query
    $sql = "SELECT * FROM producttb WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetch();

    if ($result) {
        // Get the file name from the database result
        $filename = $result['productlink'];

        if (!empty($filename)) {
            // Construct the full path to the file
            $filePath = $uploadDir . $filename;

            // Check if the file exists
            if (file_exists($filePath)) {
                // Get the file's base name
                $fileBaseName = basename($filePath);

                // Set headers to prompt for download
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . $fileBaseName . '"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($filePath));

                // Clear output buffer
                ob_clean();
                flush();
                if (empty($user['id'])) {
                    # code...
                    $customerid = 0;
                }
                $customerid = $user['id'];
                $time = date('Y-m-d');
                // Record file download in database
                $sql = "INSERT INTO downloads (customerid,book_id,date) VALUES (:customerid, :book , :date)";
                $stmt = $conn->prepare($sql);
                $stmt->execute(['book' => $filename, 'customerid' => $customerid, 'date' => $time]);
                // Read the file and output its contents
                readfile($filePath);
                exit;
                $_SESSION['success'] = "Download in progress.";
                header("location:description_page.php?id=" . $id);
            } else {
                $_SESSION['error'] = "File does not exist.";
                header("location:description_page.php?id=" . $id);
            }
        } else {
            $_SESSION['error'] = "No file specified.";
            header("location:description_page.php?id=" . $id);
        }
    } else {
        $_SESSION['error'] = "No matching record found.";
        header("location:description_page.php?id=" . $id);
    }
} else {
    $_SESSION['error'] = "Invalid ID specified.";
    header("location:description_page.php?id=" . $id);
}
