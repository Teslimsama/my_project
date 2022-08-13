<?php

// $db_connect = mysqli_connect('localhost', 'root', '', 'unibooks');

// if(!$db_connect){
//    die('error connecting to database'. mysqli_connect_error()); echo "sucess";
// } else{echo "bad";}

$servername = "localhost";
$database = "unibooks";
$username = "root";
$password = "";

$db_connect = new mysqli($servername , $username , $password ,  $database);

if ($db_connect->connect_error) {
   die("connection failed:" . $db_connect->connect_error);
}
// header("location: ../Signin");