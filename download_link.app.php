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
        $_SESSION['success'] = 'Download Successfully';
        // if ($result['type'] == 0) {
        //     header("location:description_pro.php?id=" . $id);
        // }else {
        //     header("location:description_page.php?id=" . $id);
        // }
        
        exit;
        } else {
            $_SESSION['error'] = 'Please Signin First';
            header("location:Signin");
            
        }
    } else {
        $_SESSION['error'] = "File not found.";
        // if ($result['type'] == 0) {
        //     $id = $_GET['id'];
        //     header("location:description_pro.php?id=" . $id);
        // } else {
        //     header("location:description_page.php?id=" . $id);
        // }
    }
} else {
    $_SESSION['error'] = "File ID not specified.";
    if ($result['type'] == 0) {
        $id = $_GET['id'];
        header("location:description_pro.php?id=" . $id);
    } else {
        header("location:description_page.php?id=" . $id);
    }
}


// Close database connection
$pdo->close();
