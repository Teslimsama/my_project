<?php
require 'function.php'; // Use require instead of include for better error handling

try {
	$conn = new PDO('mysql:host=localhost;dbname=unibooks', 'root', '');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	if (isset($_POST["product_id"])) {
		$productID = $_POST["product_id"];

		$query = "SELECT * FROM producttb p
            LEFT JOIN search s ON p.product_name = s.title
            WHERE s.title = :product_id
            LIMIT 1";
		$statement = $conn->prepare($query);
		$statement->bindParam(':product_id', $productID, PDO::PARAM_STR_CHAR);
		$statement->execute();

		$result = $statement->fetch(PDO::FETCH_ASSOC);
		if ($result) {
			$output = [
				"product_name" => $result["product_name"],
				"department" => $result["department"],
				"description" => $result["description"],
				"keywords" => $result["keywords"],
				"course" => $result["course"],
				"university" => $result["university"],
				"product_price" => $result["product_price"],
				"level" => $result["level"],
				"faculty" => $result["faculty"]
			];

			if ($result["product_image"]) {
				$output["product_image"] = '<img src="../images/' . $result["product_image"] . '" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_product_image" value="' . $result["product_image"] . '" />';
			} else {
				$output["product_image"] = '<input type="hidden" name="hidden_product_image" value="" />';
			}

			echo json_encode($output);
		}
	}
} catch (PDOException $e) {
	die("Database connection failed: " . $e->getMessage());
}
?>
