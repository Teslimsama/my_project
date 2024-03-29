<?php
include 'session.php';
$conn = $pdo->open();

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    try {

        $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM unibooker WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch();
        if ($row['numrows'] > 0) {
            if ($row['status']) {
                if (password_verify($password, $row['password'])) {
                    if ($row['type']) {
                        $_SESSION['admin'] = $row['id'];
                    } else {
                        $_SESSION['user'] = $row['id'];
                    }
                    // $_SESSION['success'] = 'You are logged in';
                    header('location: index');
                } else {
                    $_SESSION['error'] = 'Incorrect Password';
                    header('location: Signin');
                }
            } else {
                $_SESSION['error'] = 'Account not activated.';
                header('location: Signin');

            }
        } else {
            $_SESSION['error'] = 'Email not found';
            header('location: Signin');
            
        }
    } catch (PDOException $e) {
        echo "There is some problem in connection: " . $e->getMessage();
    }
} else {
    $_SESSION['error'] = 'Input login credentails first';
    header('location: Signin');

}

$pdo->close();

// header('location: Signin');
