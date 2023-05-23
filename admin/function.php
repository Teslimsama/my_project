<?php

function upload_image()
{
	if(isset($_FILES["product_image"]))
	{
		$extension = explode('.', $_FILES['product_image']['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = '../images/' . $new_name;
		move_uploaded_file($_FILES['product_image']['tmp_name'], $destination);
		return $new_name;
	}
}

function get_image_name($product_id)
{
	include('session.php');
	$statement = $conn->prepare("SELECT product_image FROM producttb WHERE id = '$product_id'");
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row["product_image"];
	}
}

function get_total_all_records()
{
	include('session.php');
	$statement = $conn->prepare("SELECT * FROM producttb");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}
//  function nums(){
// $conn = new PDO('mysql:host=localhost;dbname=unibooks', 'root', '');
// 	// include('session.php');
// 	$statement = $conn->prepare("SELECT * FROM producttb");
// 	$statement->execute();
// 	$result = $statement->fetchAll();
// 	$n=1;
// 	// while ($row = $result) {
// 	// 	# code...
// 	// 	echo $n;
// 	// 	$n++;
// 	// 	return;
// 	// }
// 	foreach ($result as $key) {
// 		echo $n;
// 		$n++;
// 	}
//  }
?>