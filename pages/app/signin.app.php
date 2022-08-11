<?php
include('../config/alert.message.php');
require_once('../config/db.connect.php');

if (!isset($_POST['login'])) {
  header('Location:../Signin');
}

$password = $_POST['password'];
$email = $_POST['email'];
//query db to check if user has an account
$sql = "SELECT * FROM users WHERE email=?;";
$stmt = mysqli_stmt_init($db_connect);
mysqli_stmt_prepare($stmt,$sql);
mysqli_stmt_bind_param($stmt,'s',$email);
mysqli_stmt_execute($stmt);




$result = mysqli_stmt_get_result($stmt);
if ($rows = mysqli_fetch_assoc($result)){
    if(password_verify($password,$rows['password'])){
        $_SESSION['id'] = $rows['id'];
        $_SESSION['first_name'] = $rows['firstname'];
        $_SESSION['last_name'] = $rows['lastname'];
        $_SESSION['email'] = $rows['email'];
        $_SESSION['acctype'] = $rows['acctype'];
        
        if($rows['acctype'] == 'patient'){
            header('Location:../care/patientsarea');
        }
        elseif($rows['acctype'] == 'doctor' || $rows['acctype'] == 'nurse' || $rows['acctype'] == 'radiologist' || $rows['acctype'] == 'pharmacist' || $rows['acctype'] == 'cmd'){
            header('Location:../office/dashboard');
        }
       
    }else{
        $_SESSION['error'] = 'Incorrect user password';
        header('Location:../login');
    }
}else{
    $_SESSION['error'] = 'Incorrect user email';
    header('Location:../login');
}

