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

    define('DBINFO', 'mysql:host=localhost;dbname=unibooks');
    define('DBUSER','root');
    define('DBPASS','');

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

$sql = "SELECT * FROM producttb";

$result = mysqli_query($db_connect, $sql);

if (mysqli_num_rows($result) > 0) {
    return $result;
}
?>