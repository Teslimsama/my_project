<?php
include('../config/alert.message.php');
require_once('../config/database.php');

 


$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$username = $_POST['username'];
$level = $_POST['levell'];
$dept = $_POST['dept'];
$course = $_POST['course'];
$faculty = $_POST['faculty'];
$student_id = $_SESSION['id'];
$dob = $_POST['dob'];
 
// Processing form data when form is submitted
if(isset($_POST['submit'])){
 
    
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE unibooker SET firstname='$first_name',lastname='$last_name',phone='$phone',level='$level',faculty='$faculty',department='$dept',course='$course',school='$school',password,dob='$dob',email='$email',username='$username'  WHERE id = '$student_id'";
        
        if($stmt = mysqli_prepare($db_connect, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssssss", $first_name,$last_name,$phone,$level,$faculty,$dept,$course,$school,$password,$dob,$email,$username,);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: ../profilepage");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    header("location: ../profilepage");
}
?>
 
