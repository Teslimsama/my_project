<?php
	include 'database.php';
	include 'alert.message.php';
	session_start();


	if(isset($_SESSION['admin'])){
		header('location: admin/index');
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
// Generate the placeholder URL
// $placeholder_url = "https://placehold.co/600x400?text=" . urlencode($first_name . " " . $last_name);
