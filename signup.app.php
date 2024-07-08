<?php
include 'session.php';

// Collect data from form
if (isset($_POST['submit'])) {
    // Sanitize and assign form data to variables
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $level = htmlspecialchars($_POST['levell']);
    $referral = htmlspecialchars($_POST['refer']);
    $gender = htmlspecialchars($_POST['gender']);
    $dob = htmlspecialchars($_POST['dob']);
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $university = ucwords(htmlspecialchars($_POST['university']));
    $faculty = ucwords(htmlspecialchars($_POST['faculty']));
    $department = ucwords(htmlspecialchars($_POST['department']));
    $course = ucwords(htmlspecialchars($_POST['course']));

    // Store some data in session variables
    $_SESSION['firstname'] = $firstname;
    $_SESSION['lastname'] = $lastname;
    $_SESSION['email'] = $email;

    // Validate password match
    if ($password != $repassword) {
        $_SESSION['error'] = 'Passwords did not match';
        header('location: Signup');
        exit();
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM unibooker WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $row = $stmt->fetch();
    if ($row['numrows'] > 0) {
        $_SESSION['error'] = 'Email already taken';
        header('location: Signup');
        exit();
    } else {
        // Check if university, faculty, department, and course combination exists
        $stmt = $conn->prepare("SELECT * FROM university_faculty_department WHERE university = ? AND faculty = ? AND department = ? AND course = ?");
        $stmt->execute([$university, $faculty, $department, $course]);
        $existingRow = $stmt->fetch();

        if (!$existingRow) {
            // Insert new combination if it doesn't exist
            $stmt = $conn->prepare("INSERT INTO university_faculty_department (university, faculty, department, course) VALUES (?, ?, ?, ?)");
            $stmt->execute([$university, $faculty, $department, $course]);
        }

        $now = date('Y-m-d');
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Generate a unique code
        $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = substr(str_shuffle($set), 0, 12);

        try {
            // Insert new user into the database
            $stmt = $conn->prepare("INSERT INTO unibooker (email, password, firstname, lastname, gender, dob, phone, level, code, date, reference, school, faculty, department, course) VALUES (:email, :password, :firstname, :lastname, :gender, :dob, :phone, :level, :code, :date, :reference, :school, :faculty, :department, :course)");
            $stmt->execute([
                'email' => $email,
                'password' => $hashedPassword,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'gender' => $gender,
                'dob' => $dob,
                'phone' => $phone,
                'level' => $level,
                'code' => $code,
                'date' => $now,
                'reference' => $referral,
                'school' => $university,
                'faculty' => $faculty,
                'department' => $department,
                'course' => $course
            ]);
            $userid = $conn->lastInsertId();

            // Send activation email
            $message = "
                <h2>Thank you for Registering.</h2>
                <p>Your Account:</p>
                <p>Email: " . $email . "</p>
                <p>Password: " . $_POST['password'] . "</p>
                <p>Please click the link below to activate your account.</p>
                <a href='http://localhost/bolakaz/activate.php?code=" . $code . "&user=" . $userid . "'>Activate Account</a>
            ";

            $to = $email;
            $subject = "Account Activation";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1" . "\r\n";
            $headers .= "From: bolajiteslim05@gmail.com";

            if (mail($to, $subject, $message, $headers)) {
                unset($_SESSION['firstname']);
                unset($_SESSION['lastname']);
                unset($_SESSION['email']);

                $_SESSION['success'] = 'Account created. Check your email to activate.';
                header('location: Signin');
                exit();
            } else {
                $_SESSION['error'] = 'Message could not be sent. Please try again.';
                header('location: Signup');
                exit();
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
            header('location: Signup');
            exit();
        }

        $conn = null; // Close the database connection
    }
} else {
    $_SESSION['error'] = 'Fill up Signup form first';
    header('location: Signup');
    exit();
}
