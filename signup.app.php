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
        $activate_code = substr(str_shuffle($set), 0, 12);

        try {
            // Insert new user into the database
            $stmt = $conn->prepare("INSERT INTO unibooker (email, password, firstname, lastname, gender, dob, phone, level, activate_code, date, reference, school, faculty, department, course, type, code, status) VALUES (:email, :password, :firstname, :lastname, :gender, :dob, :phone, :level,  :activate_code, :date, :reference, :school, :faculty, :department, :course, :type, :code, :status)");
            $stmt->execute([
                'email' => $email,
                'password' => $hashedPassword,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'gender' => $gender,
                'dob' => $dob,
                'phone' => $phone,
                'level' => $level,
                'activate_code' => $activate_code,
                'date' => $now,
                'reference' => $referral,
                'school' => $university,
                'faculty' => $faculty,
                'department' => $department,
                'course' => $course,
                'type' => 0, // Default user type
                'code' => $code,
                'status' => 0 // Default inactive status
            ]);
            $userid = $conn->lastInsertId();

            // Send activation email
            $message = "
            <!DOCTYPE html>
            <html>
            <head>
                <style>
                    body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
                    .container { max-width: 600px; margin: 30px auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
                    .header { background-color: #6366f1; padding: 20px; text-align: center; }
                    .header img { max-height: 50px; }
                    .content { padding: 30px; color: #333333; line-height: 1.6; }
                    .h1 { color: #1e293b; font-size: 24px; font-weight: bold; margin-bottom: 10px; }
                    .info-box { background-color: #f8fafc; padding: 15px; border-radius: 6px; border: 1px solid #e2e8f0; margin: 20px 0; }
                    .btn-container { text-align: center; margin: 30px 0; }
                    .btn { background-color: #6366f1; color: #ffffff !important; text-decoration: none; padding: 12px 30px; border-radius: 50px; font-weight: bold; display: inline-block; font-size: 16px; }
                    .footer { background-color: #1e293b; color: #94a3b8; text-align: center; padding: 20px; font-size: 12px; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        <!-- Replace with actual hosted logo URL if available, otherwise alt text shows -->
                        <h2 style='color: white; margin: 0;'>Unibooks</h2>
                    </div>
                    <div class='content'>
                        <div class='h1'>Welcome, " . $firstname . "!</div>
                        <p>Thank you for joining Unibooks. We are excited to have you on board.</p>
                        
                        <div class='info-box'>
                            <strong>Your Account Details:</strong><br>
                            Email: " . $email . "<br>
                            Password: " . $_POST['password'] . "
                        </div>

                        <p>Please confirm your email address to activate your account and start exploring.</p>

                        <div class='btn-container'>
                            <a href='http://localhost/my_project/activate.php?code=" . $activate_code . "&user=" . $userid . "' class='btn'>Activate My Account</a>
                        </div>
                        
                        <p style='font-size: 13px; color: #666;'>If the button above does not work, paste this link into your browser:<br>
                        http://localhost/my_project/activate.php?code=" . $activate_code . "&user=" . $userid . "</p>
                    </div>
                    <div class='footer'>
                        &copy; " . date('Y') . " Unibooks. All rights reserved.
                    </div>
                </div>
            </body>
            </html>
            ";

            $to = $email;
            $subject = "Action Required: Activate your Unibooks Account";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
            $headers .= "From: Unibooks <no-reply@unibooks.com.ng>" . "\r\n";

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
