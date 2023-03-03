<?php
    include 'session.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve file details from database
    $sql = "SELECT * FROM producttb WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetch();

    if ($result > 1) {
        if ($user['id']) {
        
        $filename = $result['product_name'];
        $filebook = $result['productlink'];
        $filepath = "../unibooks_download/" . $filebook;
        $customerid = $user['id'];
        $time = date("Y-m-d");
        echo $filename;

        // Record file download in database
        $sql = "INSERT INTO downloads (customerid,book_id,date) VALUES (:customerid, :book , :date)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['book'=>$filename,'customerid'=>$customerid,'date'=>$time]);

        // Download file
        header("Content-type: application/octet-stream");
        header("Content-disposition: attachment; filename=" . $filebook);
        header("Content-length: " . filesize($filepath));
        readfile($filepath);
        exit;
        $_SESSION['success'] = 'Download Successfully';
        header("location:javascript://history.go(-1)");
        } else {
            $_SESSION['error'] = $e->getMessage();
            header("location:javascript://history.go(-1)");
        }
    } else {
        echo "File not found.";
        // print_r( $result);
    }
} else {
    echo "File ID not specified.";
}

// Close database connection
$pdo->close();
