<?php

include('session.php');
include('function.php');
if (isset($_POST["operation"])) {
	if ($_POST["operation"] == "Add") {
		$image = '';
		if ($_FILES["product_image"]["name"] != '') {
			$image = upload_image();
		}
		$statement = $conn->prepare("
			INSERT INTO producttb (product_name, product_price, product_image) 
			VALUES (:product_name, :product_price, :product_image)
		");
		$result = $statement->execute(
			array(
				':product_name'	=>	$_POST["product_name"],
				':product_price'	=>	$_POST["product_price"],
				':product_image'		=>	$image
			)
		);
		if (!empty($result)) {
			echo 'Data Inserted';
		}
	}
	if ($_POST["operation"] == "Edit") {
		$image = '';
		if ($_FILES["product_image"]["name"] != '') {
			$image = upload_image();
		} else {
			$image = $_POST["hidden_product_image"];
		}
		$statement = $conn->prepare(
			"UPDATE producttb p
            LEFT JOIN search s ON p.product_name = s.title
			SET p.product_name = :product_name, p.product_price = :product_price, p.product_image = :product_image, p.type = :type ,p.university = :university ,p.faculty = :faculty ,p.department = :department,p.level = :level,s.keywords = :keywords,s.description = :description,p.course=:course
			WHERE p.product_name = :product_id
			"
		);
		$result = $statement->execute(
			array(
				':product_name'	=>	$_POST["product_name"],
				':product_price'	=>	$_POST["product_price"],
				':product_image'		=>	$image,
				':type'		=>	$_POST['type'],
				':university'		=>	$_POST['university'],
				':faculty'		=>	$_POST['faculty'],
				':department'		=>	$_POST['department'],
				':level'		=>	$_POST['level'],
				':description'		=>	$_POST['desc'],
				':course'		=>	$_POST['course'],
				':keywords'		=>	$_POST['keywords'],
				':product_id'			=>	$_POST["product_id"]
			)
		);
		if (!empty($result)) {
			echo 'Data Updated';
		}
	}
}
