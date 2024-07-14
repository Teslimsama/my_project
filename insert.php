<?php
include "session.php";
include "function.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST["operation"])) {
		// Handle the edit operation for products
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
					// Check and insert university/faculty/department/course combination
					$university = ucwords($_POST['university']);
					$faculty = ucwords($_POST['faculty']);
					$department = ucwords($_POST['department']);
					$course = ucwords($_POST['course']);

					$stmt = $conn->prepare("SELECT * FROM university_faculty_department WHERE university = ? AND faculty = ? AND department = ? AND course = ?");
					$stmt->execute([$university, $faculty, $department, $course]);
					$existingRow = $stmt->fetch();

					if ($existingRow) {
						// The combination already exists
						$_SESSION['error'] = "Combination already exists in the database.";
					} else {
						// The combination doesn't exist, insert it
						$stmt = $conn->prepare("INSERT INTO university_faculty_department (university, faculty, department, course) VALUES (?, ?, ?, ?)");
						$stmt->execute([$university, $faculty, $department, $course]);
						$_SESSION['success'] = "Combination inserted into the database.";
					}

					echo json_encode(['status' => 'success', 'message' => 'Data Updated and Combination Checked']);
				} else {
					echo json_encode(['status' => 'error', 'message' => 'Data Update Failed']);
				}
			}
		} catch (Exception $e) {
			echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
		}
	}
}
	