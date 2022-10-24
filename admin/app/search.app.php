<?php
 include_once '../config/database.php';
 include '../config/alert.message.php' ;
 
if (isset($_POST['search'])) {
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $key = $_POST['keywords'];
    $link = $_POST['link'];
    $sql = "INSERT INTO search (title, description,keywords,link) VALUES(?,?,?,?);";
  
    $stmt = mysqli_prepare($db_connect, $sql);
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt,'ssss',$title, $desc,$key,$link);
      if(mysqli_stmt_execute($stmt)){
          header("location: ../upload");
          $_SESSION['success'] = "Search Result have been Created";
    }else{
        header("location: ../upload");
        $_SESSION['error'] = "Search Result Failed to have been Created"; 
        
      }
    
  }
  else {
    echo 'didnt work asshole';
  }