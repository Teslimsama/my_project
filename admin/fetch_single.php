<?php
$conn = new PDO('mysql:host=localhost;dbname=unibooks', 'root', '');
include('function.php');
if(isset($_POST["product_id"]))
{
	$output = array();
	$statement = $conn->prepare(
		"SELECT * FROM `producttb` LEFT JOIN `search`ON producttb.id=search.id WHERE search.id = '".$_POST["product_id"]."'"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["product_name"] = $row["product_name"];
		$output["department"] = $row["department"];
		$output["description"] = $row["description"];
		$output["keywords"] = $row["keywords"];
		$output["course"] = $row["course"];
		$output["university"] = $row["university"];
		$output["product_price"] = $row["product_price"];
		$output["level"] = $row["level"];
		$output["faculty"] = $row["faculty"];
		if($row["product_image"] != '')
		{
			$output['product_image'] = '<img src="../images/'.$row["product_image"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_product_image" value="'.$row["product_image"].'" />';
		}
		else
		{
			$output['product_image'] = '<input type="hidden" name="hidden_product_image" value="" />';
		}
	}
	echo json_encode($output);
}
?>