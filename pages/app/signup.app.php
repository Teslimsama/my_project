<?php
include('../config/alert.message.php');
require_once('../config/database.php');

if (!isset($_POST['signup'])) {
    header('Location:../Signup');

}elseif (strlen($_POST['firstname']) < 2 || strlen($_POST['lastname']) < 2) {
    //checks if first name or last name is less than 2 chars
    $_SESSION['error'] = 'Please enter a valid name';
    header('Location:../Signup');
}elseif (!($_POST['password'] === $_POST['conpassword'])) {
    $_SESSION['error'] = 'Please enter a valid password';
    header('Location:../Signup');
}
//continue with a chain of elseif to check is both passwords match 

//AUTHENTIFICATION

//COLLECT DATA FROM FORM
$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$phone = $_POST['phone'];
$email = $_POST['email'];

//check if email exists
$sql_check_email = "SELECT * FROM users WHERE email='$email';";
$sql_check_email_result = mysqli_query($db_connect,$sql_check_email);
if(mysqli_num_rows($sql_check_email_result) >= 1){
    $_SESSION['error'] = 'User already exist. Please login to your account';
    header('Location:../Signin');
}

$password = password_hash($_POST['password'],PASSWORD_DEFAULT); //encrypt password
$level = $_POST['levell'];
$dept = $_POST['dept'];
$course = $_POST['course'];
$faculty = $_POST['faculty'];
$referral = $_POST['refer'];
$gender = $_POST['gender'];
$school = $_POST['school'];
$dob = $_POST['dob'];
$acct_type = 'student';

$now = new DateTime();
$timestamp = $now->getTimestamp();



//INSERT RECORDS INTO DB
$sql = "INSERT INTO unibooker (firstname,lastname,phone,level,faculty,department,course,school,gender,password,dob,reference,email,timestamp) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?);";

$stmt = mysqli_stmt_init($db_connect);
mysqli_stmt_prepare($stmt,$sql);
mysqli_stmt_bind_param($stmt,'sssssssssssssi',$first_name,$last_name,$phone,$level,$faculty,$dept,$course,$school,$gender,$password,$dob,$referral,$email,$timestamp);

if(mysqli_stmt_execute($stmt)){
    $_SESSION['success'] = 'Your registration was successful';
    header('Location:../content');
}else{
    $_SESSION['error'] = 'Error while registering';
    header('Location:../Signup');
}