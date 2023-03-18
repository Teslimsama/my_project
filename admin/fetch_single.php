<?php
$conn = new PDO('mysql:host=localhost;dbname=unibooks', 'root', '');
include('function.php');
if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $conn->prepare(
		"SELECT * FROM producttb 
		WHERE id = '".$_POST["user_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["product_name"] = $row["product_name"];
		$output["department"] = $row["department"];
		$output["product_price"] = $row["product_price"];
		$output["level"] = $row["level"];
		$output["faculty"] = $row["faculty"];
		if($row["product_image"] != '')
		{
			$output['user_image'] = '<img src="upload/'.$row["product_image"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row["product_image"].'" />';
		}
		else
		{
			$output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
		}
	}
	echo json_encode($output);
}
?>