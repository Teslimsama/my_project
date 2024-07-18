<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include "session.php";
include 'slugify.php';

function createImage($outputPath, $title, $width = 233, $height = 181)
{
	if (!extension_loaded('gd')) {
		die('GD library is not enabled.');
	}

	$image = imagecreatetruecolor($width, $height);
	$white = imagecolorallocate($image, 255, 255, 255);
	imagefill($image, 0, 0, $white);
	$black = imagecolorallocate($image, 0, 0, 0);
	$font = __DIR__ . '/Elegante Classica.ttf';

	$fontSize = 17;
	$wrappedText = wordwrap($title, 20, "\n", true);
	$lines = explode("\n", $wrappedText);
	$lineHeight = 25;
	$totalTextHeight = count($lines) * $lineHeight;
	$startY = ($height - $totalTextHeight) / 2 + $lineHeight / 2;

	foreach ($lines as $index => $line) {
		$boundingBox = imagettfbbox($fontSize, 0, $font, $line);
		$x = ($width - ($boundingBox[2] - $boundingBox[0])) / 2;
		$y = $startY + $index * $lineHeight;
		imagettftext($image, $fontSize, 0, $x, $y, $black, $font, $line);
	}

	imagejpeg($image, $outputPath);
	imagedestroy($image);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	try {
		echo "Form submitted.<br>";

		if (empty($_POST['title']) || empty($_POST['desc']) || empty($_POST['keywords'])) {
			throw new Exception("Please fill all the required fields");
		}

		$title = ucwords($_POST['title']);
		$slug = slugify($title);
		$desc = ucwords($_POST['desc']);
		$key = ucwords($_POST['keywords']);
		$type = $_POST['type'];
		$faculty = ucwords($_POST['faculty']);
		$department = ucwords($_POST['dept']);
		$course = ucwords($_POST['course']);
		$university = ucwords($_POST['university']);
		$level = $_POST['level'];
		$amount = $_POST['amount'];

		$conn->beginTransaction();

		if (isset($_POST['edit_id']) && !empty($_POST['edit_id'])) {
			echo "Edit ID: " . $_POST['edit_id'] . "<br>";
			$edit_id = $_POST['edit_id'];

			$stmt = $conn->prepare("SELECT productlink, product_image FROM producttb WHERE product_name = ?");
			$stmt->execute([$edit_id]);
			$row = $stmt->fetch();

			if ($row) {
				echo "Record found.<br>";
				$oldFileName = $row['productlink'];
				$oldImageName = $row['product_image'];

				// Check if title has changed to update image and file
				if ($title !== $edit_id) {
					echo "Title has changed.<br>";
					// Update image
					$imgname = $slug . '.png';
					$outputPath = __DIR__ . '/../assets/Images/' . $imgname;
					createImage($outputPath, $title);

					if (file_exists(__DIR__ . '/../assets/Images/' . $oldImageName)) {
						unlink(__DIR__ . '/../assets/Images/' . $oldImageName);
					}

					$stmt = $conn->prepare("UPDATE search SET title = ?, description = ?, keywords = ?, link = ? WHERE title = ?");
					$stmt->execute([$title, $desc, $key, $oldFileName, $edit_id]);
				} else {
					$imgname = $oldImageName; // Keep existing image name
				}

				// Check if a new book file has been chosen
				if (!empty($_FILES["book"]["name"])) {
					echo "New book file chosen.<br>";
					$fileName = $_FILES["book"]["name"];
					$fileSize = $_FILES["book"]["size"];
					$tmpName = $_FILES["book"]["tmp_name"];

					$validExt = ['docx', 'jpg', 'png', 'jpeg', 'pdf', 'txt'];
					$Ext = explode('.', $fileName);
					$Ext = strtolower(end($Ext));

					if (empty($fileName)) {
						throw new Exception("File does not exist");
					} elseif (!in_array($Ext, $validExt)) {
						throw new Exception("Invalid file format");
					} elseif ($fileSize > 160000000) {
						throw new Exception("File is too large");
					}

					$newFileName = $slug . '.' . $Ext;
					$location = '../unibooks_download/' . $newFileName;

					if (file_exists('../unibooks_download/' . $oldFileName)) {
						unlink('../unibooks_download/' . $oldFileName);
					}

					if (!move_uploaded_file($tmpName, $location)) {
						throw new Exception("Failed to upload file");
					}

					$stmt = $conn->prepare("UPDATE producttb p
                        LEFT JOIN search s ON p.product_name = s.title SET p.product_name = ?, p.product_image = ?, p.product_price = ?, p.productlink = ?, p.faculty = ?, p.department = ?, p.level = ?, p.course = ?, p.university = ?, p.type = ?, s.link = ?
                        WHERE p.product_name = ?");
					$stmt->execute([$title, $imgname, $amount, $newFileName, $faculty, $department, $level, $course, $university, $type, $newFileName, $edit_id]);
				} else {
					// No new book file chosen, update other details only
					echo "No new book file chosen.<br>";
					$stmt = $conn->prepare("UPDATE producttb SET product_name = ?, product_image = ?, product_price = ?, faculty = ?, department = ?, level = ?, course = ?, university = ?, type = ? WHERE product_name = ?");
					$stmt->execute([$title, $imgname, $amount, $faculty, $department, $level, $course, $university, $type, $edit_id]);
				}
			} else {
				throw new Exception("No matching record found for edit ID: " . $edit_id);
			}
		} else {
			throw new Exception("No edit ID provided.");
		}

		$conn->commit();
		echo "Commit successful.<br>";
		$_SESSION['success'] = "Successfully Updated";
	} catch (Exception $e) {
		if ($conn->inTransaction()) {
			$conn->rollBack();
		}
		$_SESSION['error'] = "Error: " . $e->getMessage();
		echo "Error: " . $e->getMessage() . "<br>";
	} catch (PDOException $e) {
		if ($conn->inTransaction()) {
			$conn->rollBack();
		}
		$_SESSION['error'] = "Database Error: " . $e->getMessage();
		echo "Database Error: " . $e->getMessage() . "<br>";
	}
	header('location: books');
	exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['edit_id'])) {
	$university = ucwords($_POST['university']);
	$faculty = ucwords($_POST['faculty']);
	$department = ucwords($_POST['dept']);
	$course = ucwords($_POST['course']);

	$stmt = $conn->prepare("SELECT * FROM university_faculty_department WHERE university = ? AND faculty = ? AND department = ? AND course = ?");
	$stmt->execute([$university, $faculty, $department, $course]);
	$existingRow = $stmt->fetch();

	if ($existingRow) {
		$_SESSION['error'] = "Combination already exists in the database.";
	} else {
		$stmt = $conn->prepare("INSERT INTO university_faculty_department (university, faculty, department, course) VALUES (?, ?, ?, ?)");
		$stmt->execute([$university, $faculty, $department, $course]);
		$_SESSION['success'] = "Combination inserted into the database.";
	}
	header('location: books');
	exit();
}
