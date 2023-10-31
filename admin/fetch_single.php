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
				// "department" => $result["department"],
				"description" => $result["description"],
				"keywords" => $result["keywords"],
				// "course" => $result["course"],
				// "university" => $result["university"],
				"product_price" => $result["product_price"],
				"level" => $result["level"],
				// "faculty" => $result["faculty"]
			];

			if ($result["product_image"]) {
				$output["product_image"] = '<img src="../images/' . $result["product_image"] . '" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_product_image" value="' . $result["product_image"] . '" />';
			} else {
				$output["product_image"] = '<input type="hidden" name="hidden_product_image" value="" />';
			}
			
			// Construct the "Level" select element with the available options
			$levelSelect = '<option value="100">100L</option>
                    <option value="200">200L</option>
                    <option value="300">300L</option>
                    <option value="400">400L</option>
                    <option value="500">500L</option>';

			// Set the selected option based on the database value
			$selectedOption = $result["level"];

			// Add the selected attribute to the option
			$levelSelect = str_replace('value="' . $selectedOption . '"', 'value="' . $selectedOption . '" selected', $levelSelect);

			$output["levelSelect"] = $levelSelect;

			// Construct the "Type" select element
			$typeSelect = '<option value="1">Books</option><option value="0">Projects</option>';
			// Set the selected option based on the database value
			$selectedOption = ($result["type"] == 1) ? '1' : '0';

			// Add the selected attribute to the option
			$typeSelect = str_replace('value="' . $selectedOption . '"', 'value="' . $selectedOption . '" selected', $typeSelect);

			$output["typeSelect"] = $typeSelect;
    
	
			// Query to get options for the "University" field
			$universityQuery = "SELECT DISTINCT university FROM university_faculty_department";
			$universityStatement = $conn->query($universityQuery);
			$universities = $universityStatement->fetchAll(PDO::FETCH_COLUMN);

			// Construct the "University" select element with the preselected option
			$universitySelect = '<option value="">Select university</option>';
			foreach ($universities as $university) {
				$selected = ($university == $result["university"]) ? 'selected' : '';
				$universitySelect .= '<option value="' . $university . '" ' . $selected . '>' . $university . '</option>';
			}
			$output["universitySelect"] = $universitySelect;

			// Query to get options for the "faculty" field
			$facultyQuery = "SELECT DISTINCT faculty FROM university_faculty_department";
			$facultyStatement = $conn->query($facultyQuery);
			$faculties = $facultyStatement->fetchAll(PDO::FETCH_COLUMN);

			// Construct the "faculty" select element with the preselected option
			$facultySelect = '<option value="">Select faculty</option>';
			foreach ($faculties as $faculty) {
				$selected = ($faculty == $result["faculty"]) ? 'selected' : '';
				$facultySelect .= '<option value="' . $faculty . '" ' . $selected . '>' . $faculty . '</option>';
			}
			$output["facultySelect"] = $facultySelect;

			// Query to get options for the "department" field
			$departmentQuery = "SELECT DISTINCT department FROM university_faculty_department";
			$departmentStatement = $conn->query($departmentQuery);
			$departments = $departmentStatement->fetchAll(PDO::FETCH_COLUMN);

			// Construct the "department" select element with the preselected option
			$departmentSelect = '<option value="">Select department</option>';
			foreach ($departments as $department) {
				$selected = ($department == $result["department"]) ? 'selected' : '';
				$departmentSelect .= '<option value="' . $department . '" ' . $selected . '>' . $department . '</option>';
			}
			$output["departmentSelect"] = $departmentSelect;

			// Query to get options for the "course" field
			$courseQuery = "SELECT DISTINCT course FROM university_faculty_department";
			$courseStatement = $conn->query($courseQuery);
			$courses = $courseStatement->fetchAll(PDO::FETCH_COLUMN);

			// Construct the "course" select element with the preselected option
			$courseSelect = '<option value="">Select course</option>';
			foreach ($courses as $course) {
				$selected = ($course == $result["course"]) ? 'selected' : '';
				$courseSelect .= '<option value="' . $course . '" ' . $selected . '>' . $course . '</option>';
			}
			$output["courseSelect"] = $courseSelect;


			// Send all HTML strings back in the response
			echo json_encode($output);
		}
	}
} catch (PDOException $e) {
	die("Database connection failed: " . $e->getMessage());
}
