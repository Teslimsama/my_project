<?php
    $filename = "../book_download/";
    if (isset($_GET['file'])) {
       $filename .= $_GET['file'];
    }

    if (file_exists($filename)) {
        $mime_type = mime_content_type($filename);
        
        header("Content-type: " . $mime_type);
        header("Content-Disposition: attachment; filename=$filename ");

        readfile("../book_download/" . $filename);
    }else{
        header("location:../content");
    }
