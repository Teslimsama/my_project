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

$sql_pro = "SELECT * FROM project";

$pro = mysqli_query($db_connect, $sql_pro);

if (mysqli_num_rows($pro) > 0) {
    return $pro;
}
?>