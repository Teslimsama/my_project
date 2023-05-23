<?php

include('session.php');
include('function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		$image = '';
		if($_FILES["product_image"]["name"] != '')
		{
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
		if(!empty($result))
		{
			echo 'Data Inserted';
		}
	}
	if($_POST["operation"] == "Edit")
	{
		$image = '';
		if($_FILES["product_image"]["name"] != '')
		{
			$image = upload_image();
		}
		else
		{
			$image = $_POST["hidden_product_image"];
		}
		$statement = $conn->prepare(
			"UPDATE producttb 
			SET product_name = :product_name, product_price = :product_price, product_image = :product_image, type = :type ,university = :university ,faculty = :faculty ,department = :department,level = :level  
			WHERE id = :id
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
				':id'			=>	$_POST["product_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}
}

?>