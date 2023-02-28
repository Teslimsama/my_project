<?php
	include ('database.php');
	session_start();


	if(isset($_SESSION['admin'])){
		header('location: admin/dashboard_admin');
	}

	if(isset($_SESSION['user'])){
		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("SELECT * FROM unibooker WHERE id=:id");
			$stmt->execute(['id'=>$_SESSION['user']]);
			$user = $stmt->fetch();
		}
		catch(PDOException $e){
			echo "There is some problem in connection: " . $e->getMessage();
		}

		$pdo->close();
	}
?>