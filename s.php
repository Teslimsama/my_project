<?php

$sql_pro = "SELECT * FROM project LIMIT $startfrom,$num_pages";

$pro = mysqli_query($db_connect, $sql_pro);

if (mysqli_num_rows($pro) > 0) {
    return $pro;
}



// if(!empty($_POST["remember"])) {
// 	setcookie ("email",$_POST["email"],time()+ 3600);
// 	setcookie ("password",$_POST["password"],time()+ 3600);
// 	echo "Cookies Set Successfuly";
// } else {
// 	setcookie("email","");
// 	setcookie("password","");
// 	header('location:../Signin');
// }


?>