<?php
// include('alert.message.php');
// include('session.php');


// //COLLECT DATA FROM FORM




// if (isset($_POST['submit'])) {
//     $firstname = $_POST['firstname'];
//     $lastname = $_POST['lastname'];
//     $phone = $_POST['phone'];
//     $email = $_POST['email'];

//     $level = $_POST['levell'];
//     $referral = $_POST['refer'];
//     $gender = $_POST['gender'];
//     $school = $_POST['school'];
//     $dob = $_POST['dob'];
//     $gender = $_POST['gender'];
//     $password = $_POST['password'];

//     $repassword = $_POST['repassword'];


//     $_SESSION['firstname'] = $firstname;
//     $_SESSION['lastname'] = $lastname;
//     $_SESSION['email'] = $email;

//     // if (!isset($_SESSION['captcha'])) {
//     // 	$secret = "6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe";
//     // 	$response = $_POST['g-recaptcha-response'];
//     // 	$remoteip = $_SERVER['REMOTE_ADDR'];
//     // 	$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";
//     // 	$data = file_get_contents($url);
//     // 	$row = json_decode($data, true);


//     // 	if ($row['success'] == true) {
//     // 		$_SESSION['captcha'] = time() + (10 * 60);
//     // 	} else {
//     // 		$_SESSION['error'] = 'Please answer recaptcha correctly';
//     // 		header('location: Signup');
//     // 		exit();
//     // 	}
//     // }

//     if ($password != $repassword) {
//         $_SESSION['error'] = 'Passwords did not match';
//         header('location: Signup');
//     } else {
//         $conn = $pdo->open();

//         $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM unibooker WHERE email=:email");
//         $stmt->execute(['email' => $email]);
//         $row = $stmt->fetch();
//         if ($row['numrows'] > 0) {
//             $_SESSION['error'] = 'Email already taken';
//             header('location: Signup');
//         } else {
//             $now = date('Y-m-d');
//             $password = password_hash($password, PASSWORD_DEFAULT);

//             //generate code
//             $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//             $code = substr(str_shuffle($set), 0, 12);

//             try {
//                 $stmt = $conn->prepare("INSERT INTO unibooker (email, password, firstname, lastname, gender,dob, phone, level, code, date, reference) VALUES (:email, :password, :firstname, :lastname, :gender, :dob, :phone, :level, :code, :date, :reference)");
//                 $stmt->execute(['email' => $email, 'password' => $password, 'firstname' => $firstname, 'lastname' => $lastname, 'gender' => $gender, 'dob' => $dob, 'phone' => $phone, 'level'=>$level, 'code' => $code, 'date' => $now, 'reference' => $referral]);
//                 $userid = $conn->lastInsertId();

//                 $message = "
// 						<h2>Thank you for Registering.</h2>
// 						<p>Your Account:</p>
// 						<p>Email: " . $email . "</p>
// 						<p>Password: " . $_POST['password'] . "</p>
// 						<p>Please click the link below to activate your account.</p>
// 						<a href='http://localhost/bolakaz/activate.php?code=" . $code . "&user=" . $userid . "'>Activate Account</a>
// 					";




//                 try {
//                     $to = $email; // Change this email to your //
//                     $subject = "$to";
//                     $header  = 'MIME-Version: 1.0' . "\r\n";
//                     $header .= 'Content-Type: text/html; charset=ISO-8859-1' . "\r\n";
//                     $From = "bolajiteslim05@gmail.com";
//                     mail($to, $subject, $message, $header);
//                     unset($_SESSION['firstname']);
//                     unset($_SESSION['lastname']);
//                     unset($_SESSION['email']);

//                     $_SESSION['success'] = 'Account created. Check your email to activate.';
//                     header('location: Signin');
//                 } catch (Exception $e) {
//                     $_SESSION['error'] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
//                     header('location: Signup');
//                 }
//             } catch (PDOException $e) {
//                 $_SESSION['error'] = $e->getMessage();
//                 header('location: Signup');
//             }

//             $pdo->close();
//         }
//     }
// } else {
//     $_SESSION['error'] = 'Fill up Signup form first';
//     header('location: Signup');
// }
?>
<?php
include('alert.message.php');
include('session.php');

// COLLECT DATA FROM FORM

if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $level = $_POST['levell'];
    $referral = $_POST['refer'];
    $gender = $_POST['gender'];
    $school = $_POST['school'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];

    $_SESSION['firstname'] = $firstname;
    $_SESSION['lastname'] = $lastname;
    $_SESSION['email'] = $email;

    // ... (code for captcha validation if needed)
     // if (!isset($_SESSION['captcha'])) {
    // 	$secret = "6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe";
    // 	$response = $_POST['g-recaptcha-response'];
    // 	$remoteip = $_SERVER['REMOTE_ADDR'];
    // 	$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";
    // 	$data = file_get_contents($url);
    // 	$row = json_decode($data, true);


    // 	if ($row['success'] == true) {
    // 		$_SESSION['captcha'] = time() + (10 * 60);
    // 	} else {
    // 		$_SESSION['error'] = 'Please answer recaptcha correctly';
    // 		header('location: Signup');
    // 		exit();
    // 	}
    // }

    if ($password != $repassword) {
        $_SESSION['error'] = 'Passwords did not match';
        header('location: Signup');
    } else {
        $conn = $pdo->open();

        // Collect University, Faculty, Department, and Course data from the form
        $university = $_POST['university'];
        $faculty = $_POST['faculty'];
        $department = $_POST['department'];
        $course = $_POST['course'];

        // Check if the combination of University, Faculty, Department, and Course already exists
        $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM courses WHERE university=:university AND faculty=:faculty AND department=:department AND course=:course");
        $stmt->execute([
            'university' => $university,
            'faculty' => $faculty,
            'department' => $department,
            'course' => $course
        ]);
        $row = $stmt->fetch();

        if ($row['numrows'] === 0) {
            // The combination doesn't exist, so insert it into the 'courses' table
            $insertStmt = $conn->prepare("INSERT INTO courses (university, faculty, department, course) VALUES (:university, :faculty, :department, :course)");
            $insertStmt->execute([
                'university' => $university,
                'faculty' => $faculty,
                'department' => $department,
                'course' => $course
            ]);
        }

        // Continue with user registration
        $now = date('Y-m-d');
        $password = password_hash($password, PASSWORD_DEFAULT);

        //generate code
        $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = substr(str_shuffle($set), 0, 12);

        try {
            $stmt = $conn->prepare("INSERT INTO unibooker (email, password, firstname, lastname, gender,dob, phone, level, code, date, reference) VALUES (:email, :password, :firstname, :lastname, :gender, :dob, :phone, :level, :code, :date, :reference)");
            $stmt->execute(['email' => $email, 'password' => $password, 'firstname' => $firstname, 'lastname' => $lastname, 'gender' => $gender, 'dob' => $dob, 'phone' => $phone, 'level'=>$level, 'code' => $code, 'date' => $now, 'reference' => $referral]);
            $userid = $conn->lastInsertId();

            $message = "
                <h2>Thank you for Registering.</h2>
                <p>Your Account:</p>
                <p>Email: " . $email . "</p>
                <p>Password: " . $_POST['password'] . "</p>
                <p>Please click the link below to activate your account.</p>
                <a href='http://localhost/bolakaz/activate.php?code=" . $code . "&user=" . $userid . "'>Activate Account</a>
            ";

            // ... (code for sending activation email)

        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
            header('location: Signup');
        }

        $pdo->close();
    }
} else {
    $_SESSION['error'] = 'Fill up Signup form first';
    header('location: Signup');
}
