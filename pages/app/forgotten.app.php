<?php
include_once 'config/database.php';
    include 'config/alert.message.php';
    $cust = $_SESSION['id'];
        // $book = $_POST['bookh'];
        // $price = $_POST['free'];
        
    $now = new DateTime();
    $timestamp = $now->getTimestamp();

        
    $sql = "INSERT INTO  downloads  (customerid,timestamp) VALUES(?,?);";

    $stmt = mysqli_stmt_init($db_connect);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,'ii',$cust,$timestamp);
    
 if ( mysqli_stmt_execute($stmt)) {
    header('location: ../description_page');
 }
