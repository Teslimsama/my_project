<?php

include('session.php');
include('function.php');

if (isset($_POST["operation"])) {
	try {
		if ($_POST["operation"] == "Edit") {
			$image = '';
			if ($_FILES["product_image"]["name"] != '') {
				$image = upload_image();
			} else {
				$image = $_POST["hidden_product_image"];
			}

			$statement = $conn->prepare("
                UPDATE producttb p
                LEFT JOIN search s ON p.product_name = s.title
                SET 
                    p.product_name = :product_name, 
                    p.product_price = :product_price, 
                    p.product_image = :product_image, 
                    p.type = :type, 
                    p.university = :university, 
                    p.faculty = :faculty, 
                    p.department = :department,
                    p.level = :level, 
                    s.keywords = :keywords,
                    s.description = :description,
                    p.course = :course
                WHERE p.product_name = :product_id
            ");

			$result = $statement->execute([
				':product_name' => $_POST["product_name"],
				':product_price' => $_POST["product_price"],
				':product_image' => $image,
				':type' => $_POST['type'],
				':university' => $_POST['university'],
				':faculty' => $_POST['faculty'],
				':department' => $_POST['department'],
				':level' => $_POST['level'],
				':description' => $_POST['description'],
				':course' => $_POST['course'],
				':keywords' => $_POST['keywords'],
				':product_id' => $_POST["product_id"]
			]);

			if ($result) {
				echo json_encode(['status' => 'success', 'message' => 'Data Updated']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Data Update Failed']);
			}
		}
	} catch (Exception $e) {
		echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
	}
}
