<?php
include "session.php";
include 'slugify.php';

function createImage($outputPath, $title, $width = 233, $height = 181)
{
    // Check if the GD library is enabled
    if (!extension_loaded('gd')) {
        die('GD library is not enabled.');
    }

    // Create a blank image
    $image = imagecreatetruecolor($width, $height);

    // Set the background color to white
    $white = imagecolorallocate($image, 255, 255, 255);
    imagefill($image, 0, 0, $white);

    // Set the text color to black
    $black = imagecolorallocate($image, 0, 0, 0);

    // Set the path to the font you want to use
    $font = __DIR__ . '/Elegante Classica.ttf'; // Ensure this path is correct and the font file exists

    // Define text and positions
    $fontSize = 17; // Adjust font size as necessary

    // Split the title into multiple lines to fit within the image width
    $wrappedText = wordwrap($title, 20, "\n", true); // Adjust the character limit as necessary
    $lines = explode("\n", $wrappedText);

    // Calculate positions dynamically based on the dimensions of the image
    $lineHeight = 25; // Approximate line height for the font size
    $totalTextHeight = count($lines) * $lineHeight;
    $startY = ($height - $totalTextHeight) / 2 + $lineHeight / 2; // Start position for the first line

    // Add text to the image
    foreach ($lines as $index => $line) {
        $boundingBox = imagettfbbox($fontSize, 0, $font, $line);
        $x = ($width - ($boundingBox[2] - $boundingBox[0])) / 2;
        $y = $startY + $index * $lineHeight;
        imagettftext($image, $fontSize, 0, $x, $y, $black, $font, $line);
    }

    // Save the image to a file
    imagejpeg($image, $outputPath);

    // Free up memory
    imagedestroy($image);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        if (!isset($_POST['search']) || empty($_POST['title']) || empty($_POST['desc']) || empty($_POST['keywords'])) {
            throw new Exception("Please fill all the required fields");
        }

        $title = ucwords($_POST['title']);
        $slug = slugify($title);
        $desc = ucwords($_POST['desc']);
        $key = ucwords($_POST['keywords']);
        $type = $_POST['type'];
        $link = slugify($title);
        $faculty = ucwords($_POST['faculty']);
        $department = ucwords($_POST['dept']);
        $course = ucwords($_POST['course']);
        $university = ucwords($_POST['university']);
        $level = $_POST['level'];
        $amount = $_POST['amount'];
        $photo = $_FILES['img']['name'];

        // File validations
        $fileName = $_FILES["book"]["name"];
        $fileSize = $_FILES["book"]["size"];
        $tmpName = $_FILES["book"]["tmp_name"];

        // Generate the image using the function
        $imgname = $slug . '.png';
        $outputPath = __DIR__ . '/../assets/Images/' . $imgname;
        createImage($outputPath, $title);

        $validExt = ['docx', 'jpg', 'png', 'jpeg', 'pdf', 'txt'];
        $Ext = explode('.', $fileName);
        $Ext = strtolower(end($Ext));

        if (empty($fileName)) {
            throw new Exception("File does not exist");
        } elseif (!in_array($Ext, $validExt)) {
            throw new Exception("Invalid file format");
        } elseif ($fileSize > 160000000) {
            throw new Exception("File is too large");
        } else {
            $newFileName = $slug . '.' . $Ext;
            $location = '../unibooks_download/' . $newFileName;

            // Database operations
            $conn->beginTransaction();
            $stmt = $conn->prepare("INSERT INTO search (title, description, keywords, link) VALUES (?, ?, ?, ?)");
            $stmt->execute([$title, $desc, $key, $newFileName]);

            if (!move_uploaded_file($tmpName, $location)) {
                throw new Exception("Failed to upload file");
            }

            $stmt = $conn->prepare("INSERT INTO producttb (product_name, product_image, product_price, productlink, faculty, department, level, course, university, type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$title, $imgname, $amount, $newFileName, $faculty, $department, $level, $course, $university, $type]);

            $conn->commit();
            $_SESSION['success'] = "Successfully Added";
        }
    } catch (Exception $e) {
        if ($conn->inTransaction()) {
            $conn->rollBack();
        }
        $_SESSION['error'] = "Error: " . $e->getMessage();
    } catch (PDOException $e) {
        if ($conn->inTransaction()) {
            $conn->rollBack();
        }
        $_SESSION['error'] = "Database Error: " . $e->getMessage();
    }
    header('location:books_add');
}

// Handle the university/faculty/department/course combination check and insertion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $university = ucwords($_POST['university']);
    $faculty = ucwords($_POST['faculty']);
    $department = ucwords($_POST['department']);
    $course = ucwords($_POST['course']);

    // Check if the combination exists
    $stmt = $conn->prepare("SELECT * FROM university_faculty_department WHERE university = ? AND faculty = ? AND department = ? AND course = ?");
    $stmt->execute([$university, $faculty, $department, $course]);
    $existingRow = $stmt->fetch();

    if ($existingRow) {
        // The combination already exists
        $_SESSION['error'] = "Combination already exists in the database.";
        header('location:books_add');
    } else {
        // The combination doesn't exist, insert it
        $stmt = $conn->prepare("INSERT INTO university_faculty_department (university, faculty, department, course) VALUES (?, ?, ?, ?)");
        $stmt->execute([$university, $faculty, $department, $course]);
        $_SESSION['success'] = "Combination inserted into the database.";
        header('location:books_add');
    }
}
// include "session.php";
// include 'slugify.php';

// function createImage($outputPath, $title, $width = 233, $height = 181)
// {
//   // Check if the GD library is enabled
//   if (!extension_loaded('gd')) {
//     die('GD library is not enabled.');
//   }

//   // Create a blank image
//   $image = imagecreatetruecolor($width, $height);

//   // Set the background color to white
//   $white = imagecolorallocate($image, 255, 255, 255);
//   imagefill($image, 0, 0, $white);

//   // Set the text color to black
//   $black = imagecolorallocate($image, 0, 0, 0);

//   // Set the path to the font you want to use
//   $font = __DIR__ . '/Elegante Classica.ttf'; // Ensure this path is correct and the font file exists

//   // Define text and positions
//   $fontSize = 16; // Adjust font size as necessary

//   // Split the title into multiple lines to fit within the image width
//   $wrappedText = wordwrap($title, 20, "\n", true); // Adjust the character limit as necessary
//   $lines = explode("\n", $wrappedText);

//   // Calculate positions dynamically based on the dimensions of the image
//   $lineHeight = 25; // Approximate line height for the font size
//   $totalTextHeight = count($lines) * $lineHeight;
//   $startY = ($height - $totalTextHeight) / 2 + $lineHeight / 2; // Start position for the first line

//   // Add text to the image
//   foreach ($lines as $index => $line) {
//     $boundingBox = imagettfbbox($fontSize, 0, $font, $line);
//     $x = ($width - ($boundingBox[2] - $boundingBox[0])) / 2;
//     $y = $startY + $index * $lineHeight;
//     imagettftext($image, $fontSize, 0, $x, $y, $black, $font, $line);
//   }

//   // Save the image to a file
//   imagejpeg($image, $outputPath);

//   // Free up memory
//   imagedestroy($image);
// }

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//   try {
//     if (!isset($_POST['search']) || empty($_POST['title']) || empty($_POST['desc']) || empty($_POST['keywords'])) {
//       throw new Exception("Please fill all the required fields");
//     }

//     $title = $_POST['title'];
//     $slug = slugify($title);
//     $desc = $_POST['desc'];
//     $key = $_POST['keywords'];
//     $type = $_POST['type'];
//     $link = slugify($title);
//     $faculty = $_POST['faculty'];
//     $department = $_POST['dept'];
//     $course = $_POST['course'];
//     $university = $_POST['university'];
//     $level = $_POST['level'];
//     $amount = $_POST['amount'];
//     $photo = $_FILES['img']['name'];

//     // File validations
//     $fileName = $_FILES["book"]["name"];
//     $fileSize = $_FILES["book"]["size"];
//     $tmpName = $_FILES["book"]["tmp_name"];

//     // Commented out the image upload part
//     /*
//     if (!empty($photo)) {
//       $ExtI = explode('.', $photo);
//       $ExtI = strtolower(end($ExtI));
//       if (!move_uploaded_file($_FILES['img']['tmp_name'], '../assets/Images/' . $slug . '.' . $ExtI)) {
//         throw new Exception("Failed to upload image");
//       }
//       $imgname = $slug . '.' . $ExtI;
//     } else {
//       $imgname = 'noimage.jpg';
//     }
//     */

//     // Generate the image using the function
//     $imgname = $slug . '.jpg';
//     $outputPath = __DIR__ . '/../assets/Images/' . $imgname;
//     createImage($outputPath, $title);

//     $validExt = ['docx', 'jpg', 'png', 'jpeg', 'pdf', 'txt'];
//     $Ext = explode('.', $fileName);
//     $Ext = strtolower(end($Ext));

//     if (empty($fileName)) {
//       throw new Exception("File does not exist");
//     } elseif (!in_array($Ext, $validExt)) {
//       throw new Exception("Invalid file format");
//     } elseif ($fileSize > 160000000) {
//       throw new Exception("File is too large");
//     } else {
//       $newFileName = $slug . '.' . $Ext;
//       $location = '../unibooks_download/' . $newFileName;

//       // Database operations
//       $conn->beginTransaction();
//       $stmt = $conn->prepare("INSERT INTO search (title, description, keywords, link) VALUES (?, ?, ?, ?)");
//       $stmt->execute([$title, $desc, $key, $newFileName]);

//       if (!move_uploaded_file($tmpName, $location)) {
//         throw new Exception("Failed to upload file");
//       }

//       $stmt = $conn->prepare("INSERT INTO producttb (product_name, product_image, product_price, productlink, faculty, department, level, course, university, type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
//       $stmt->execute([$title, $imgname, $amount, $newFileName, $faculty, $department, $level, $course, $university, $type]);

//       $conn->commit();
//       $_SESSION['success'] = "Successfully Added";
//     }
//   } catch (Exception $e) {
//     if ($conn->inTransaction()) {
//       $conn->rollBack();
//     }
//     $_SESSION['error'] = "Error: " . $e->getMessage();
//   } catch (PDOException $e) {
//     if ($conn->inTransaction()) {
//       $conn->rollBack();
//     }
//     $_SESSION['error'] = "Database Error: " . $e->getMessage();
//   }
//   header('location:books_add');
// }
