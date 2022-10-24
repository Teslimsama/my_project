<?php
include_once 'config/database.php';
    include 'config/alert.message.php';
   
    
 
    $filename = "../unibooks_download/";
    if (isset($_GET['file'])) {
       $filename .= $_GET['file'];
    }

    if (file_exists($filename)) {
        $mime_type = mime_content_type($filename);
        
        header("Content-type: " . $mime_type);
        header("Content-Disposition: attachment; filename=$filename ");

        readfile("../book_download/" . $filename);
    }else{
        header("location:../description_page");
    }
    
//  }else{
    //     header("location:../" . $_POST['book'] );
    // }