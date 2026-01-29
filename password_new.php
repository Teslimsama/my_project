<?php
include 'session.php';

if (!isset($_GET['code']) or !isset($_GET['email'])) {
	header('location: index.php');
	exit();
}

$path = 'password_reset.php?code=' . $_GET['code'] . '&email=' . $_GET['email'];

if (isset($_POST['reset'])) {
	$password = $_POST['password'];
	$repassword = $_POST['repassword'];

	if ($password != $repassword) {
		$_SESSION['error'] = 'Passwords did not match';
		header('location: ' . $path);
		exit();
	} else {
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM unibooker WHERE code=:code AND email=:email");
		$stmt->execute(['code' => $_GET['code'], 'email' => $_GET['email']]);
		$row = $stmt->fetch();

		if ($row['numrows'] > 0) {
			$password = password_hash($password, PASSWORD_DEFAULT);

			try {
				$stmt = $conn->prepare("UPDATE unibooker SET password=:password WHERE id=:id");
				$stmt->execute(['password' => $password, 'id' => $row['id']]);

				$_SESSION['success'] = 'Password successfully reset';
				header('location: Signin');
				exit();
			} catch (PDOException $e) {
				$_SESSION['error'] = $e->getMessage();
				header('location: ' . $path);
				exit();
			}
		} else {
			$_SESSION['error'] = 'Invalid or expired reset link';
			header('location: ' . $path);
			exit();
		}

		$pdo->close();
	}
} else {
	$_SESSION['error'] = 'Input new password first';
	header('location: ' . $path);
	exit();
}
