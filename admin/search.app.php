<?php
include "session.php";
include 'slugify.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['search']) && !empty($_POST['title']) && !empty($_POST['desc']) && !empty($_POST['keywords'])) {
    $title = $_POST['title'];
    $slug =slugify($title);
    $desc = $_POST['desc'];
    $key = $_POST['keywords'];
    $type= $_POST['type'];
    $link = slugify($title);
    $faculty = $_POST['faculty'];
    $department= $_POST['dept'];
    $level= $_POST['level'];
    $amount= $_POST['amount'];
    $photo =$_FILES['img']['name'];

    $fileName = $_FILES["book"]["name"];
    $fileSize = $_FILES["book"]["size"];
    $tmpName = $_FILES["book"]["tmp_name"];
    if (!empty($photo)) {
    $ExtI = explode('.', $photo);
    $ExtI = strtolower(end($ExtI));
      move_uploaded_file($_FILES['img']['tmp_name'], '../Images/' . $slug . '.'.$ExtI);
      $imgname = $slug . '.'.$ExtI;
    } else {
      $imgname = 'noimage.jpg';
    }

    $validExt = ['docx','jpg','png','jpeg' , 'pdf', 'txt'];
    $Ext = explode('.', $fileName);
    $Ext = strtolower(end($Ext));

    if (empty($fileName)) {
      $_SESSION['error'] = "File does not exist";
    } elseif (!in_array($Ext, $validExt)) {
      $_SESSION['error'] = "Invalid file format";
    } elseif ($fileSize > 1000000) {
      $_SESSION['error'] = "File is too large";
    } else {
      $newFileName = $slug . '.' . $Ext;
      $location = '../unibooks_download/' . $newFileName;

      try {
        // prepare sql and bind parameters
        $stmt = $conn->prepare("INSERT INTO search (title, description, keywords, link) VALUES (?, ?, ?, ?)");
        $stmt->execute(array($title, $desc, $key, $newFileName));
        move_uploaded_file($tmpName, $location);
        $stmt = $conn->prepare("INSERT INTO producttb (product_name, product_image, product_price, productlink, faculty, department, level, type) VALUES (?, ?, ?, ?, ?, ?, ? ,?)");
        $stmt->execute(array($title, $imgname, $amount,$newFileName, $faculty,$department,$level, $type));
        $_SESSION['success'] = "Successfully Added";
      } catch (PDOException $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
      }
    }
  } else {
    $_SESSION['error'] = "Please fill all the required fields";
  }
  header('location:upload');
}
