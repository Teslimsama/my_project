<?php
	include 'config/database.php';
	session_start();

	if(isset($_SESSION['admin'])){
		header('location: admin/home.php');
	}

	if(isset($_SESSION['user'])){
	// $conn = $pdo->open();



		try{
			mysqli_stmt_init($db_connect);
			$sql = "SELECT * FROM users WHERE id=:id";
			$stmt = mysqli_prepare($db_connect, $sql);
			if (['id'=>$_SESSION['user']]) {
				# code...
				mysqli_stmt_execute($stmt);
			}
			

			// $stmt->execute([]);
			// $user = $stmt->fetch();
		}
		catch(PDOException $e){
			echo "There is some problem in connection: " . $e->getMessage();
		}

		$pdo->close();
	}
