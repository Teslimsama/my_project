<?php
include('session.php');


 


// $first_name = $_POST['firstname'];
// $last_name = $_POST['lastname'];
// $phone = $_POST['phone'];
// $email = $_POST['email'];
// // $username = $_POST['username'];
// $level = $_POST['levell'];
// $dept = $_POST['dept'];
// $course = $_POST['course'];
// $faculty = $_POST['faculty'];
// $dob = $_POST['dob'];

// // Processing form data when form is submitted
// if(isset($_POST['submit'])){



//     // Check input errors before updating the database
//     if(empty($new_password_err) && empty($confirm_password_err)){
//         // Prepare an update statement
//         $sql = "UPDATE unibooker SET firstname=:first_name',lastname=:last_name',phone=:phone',level=:level',faculty=:faculty',department=:dept',course=:course',school=:school',dob=:dob',email=:email',username=:username'  WHERE id = '$student_id'";

//         if($stmt = mysqli_prepare($db_connect, $sql)){

//             // Attempt to execute the prepared statement
//             if(mysqli_stmt_execute($stmt)){
//                 // Password updated successfully. Destroy the session, and redirect to login page
//                 $_SESSION['success'] = 'Your Details Have Been Updated Successfuly';
//                 header("location: ../profilepage");
//                 exit();
//             } else{
//                 $_SESSION['error'] = 'Failure Updating Your Details';

//             }

//             // Close statement
//             mysqli_stmt_close($stmt);
//         }
//     }

//     // Close connection
// }
if (isset($_POST['submit'])) {
    $curr_password = $_POST['curr_password'];
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $university = $_POST['university'];

    $password = $_POST['password'];
    // $username = $_POST['username'];
    $level = $_POST['levell'];
    $dept = $_POST['dept'];
    $course = $_POST['course'];
    $faculty = $_POST['faculty'];
    $dob = $_POST['dob'];
    
    $photo = $_FILES['photo']['name'];
    if (password_verify($curr_password, $user['password'])) {
        if (!empty($photo)) {
            move_uploaded_file($_FILES['photo']['tmp_name'], 'pfp/' . $photo);
            $filename = $photo;
        } else {
            $filename = $user['photo'];
        }

        if ($password == $user['password']) {
            $password = $user['password'];
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
        }

        $conn = $pdo->open();

        try {
            $stmt = $conn->prepare("UPDATE unibooker SET email=:email, password=:password, firstname=:firstname, lastname=:lastname, level=:level,school=:school,faculty=:faculty,department=:department,course=:course, image=:image WHERE id=:id");
            $stmt->execute(['email' => $email, 'password' => $password, 'firstname' => $first_name, 'lastname' => $last_name,   'level'=>$level,'school'=>$university, 'faculty'=>$faculty, 'department'=>$dept, 'course'=>$course, 'image' => $filename, 'id' => $user['id']]);

            $_SESSION['success'] = 'Account updated successfully';
        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        $pdo->close();
    } else {
        $_SESSION['error'] = 'Incorrect password';
    }
} else {
    $_SESSION['error'] = 'Fill up required details first';
}

    header("location: profilepage");
?>
 
