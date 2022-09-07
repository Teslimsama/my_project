<?php

// $db_connect = mysqli_connect('localhost', 'root', '', 'unibooks');

// if(!$db_connect){
//    die('error connecting to database'. mysqli_connect_error()); echo "sucess";
// } else{echo "bad";}

$servername = "unibooks_unibooks";
$database = "unibooks_unibooks";
$username = "unibooks_unibooks";
$password = "Olabode2085";

$db_connect = new mysqli($servername , $username , $password ,  $database);

if ($db_connect->connect_error) {
   die("connection failed:" . $db_connect->connect_error);
}
// header("location: ../Signin");

define('DBINFO', 'mysql:host=unibooks_unibooks;dbname=unibooks_unibooks');
define('DBUSER','unibooks_unibooks');
define('DBPASS','Olabode2085');

function fetchAll($query){
    $con = new PDO(DBINFO, DBUSER, DBPASS);
    $stmt = $con->query($query);
    return $stmt->fetchAll();
}
function performQuery($query){
    $con = new PDO(DBINFO, DBUSER, DBPASS);
    $stmt = $con->prepare($query);
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}