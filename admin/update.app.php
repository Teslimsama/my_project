<?php
include "session.php";
include 'slugify.php'; // Assuming this is a custom function for creating slugs

// Initialize variables
$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$email = $_POST['email'];
$username = $_POST['username'];
$id = $admin['id'];
$dob = $_POST['dob'];
$image = $_FILES['pfp'];
$phone = $_POST['phone'];

// Check if an image was uploaded
if ($image['error'] == UPLOAD_ERR_OK) {
    // Set the target directory
    $target_dir = "../pfp/";

    // Create a new filename using the naming convention and slugify function
    $slug = slugify($first_name . " " . $last_name . " unibooks.com.ng");
    $imageFileType = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
    $new_file_name = $slug . '.' . $imageFileType;
    $target_file = $target_dir . $new_file_name;

    // Check if file is an actual image
    $check = getimagesize($image["tmp_name"]);
    if ($check !== false) {
        // Check file size (e.g., 5MB limit)
        if ($image["size"] <= 5000000) {
            // Allow certain file formats
            if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                // Delete the existing image if it exists
                if (!empty($admin['image']) && file_exists($admin['image'])) {
                    unlink($admin['image']);
                }

                // Attempt to move the uploaded file to the target directory
                if (move_uploaded_file($image["tmp_name"], $target_file)) {
                    $image_path = $target_file;
                } else {
                    $_SESSION['error'] = "Sorry, there was an error uploading your file.";
                    header("location: update_details");
                    exit();
                }
            } else {
                $_SESSION['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                header("location: update_details");
                exit();
            }
        } else {
            $_SESSION['error'] = "Sorry, your file is too large.";
            header("location: update_details");
            exit();
        }
    } else {
        $_SESSION['error'] = "File is not an image.";
        header("location: update_details");
        exit();
    }
} else {
    $image_path = null; // No new image uploaded, use the existing image path if needed
}

if (isset($_POST['submit'])) {
    // Prepare an update statement with bound parameters to sanitize the inputs
    $sql = "UPDATE unibooker 
            SET firstname = :firstname,
                lastname = :lastname,
                phone = :phone,
                dob = :dob,
                email = :email,
                username = :username";

    // Add image path to the query if a new image was uploaded
    if ($image_path) {
        $sql .= ", image = :image";
    }

    $sql .= " WHERE id = :id";

    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters to statement
        $stmt->bindParam(':firstname', $first_name, PDO::PARAM_STR);
        $stmt->bindParam(':lastname', $last_name, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':dob', $dob, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($image_path) {
            $stmt->bindParam(':image', $image_path, PDO::PARAM_STR);
        }

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Update successful
            $_SESSION['success'] = "Profile Update Successful";
            header("location: update_details");
            exit();
        } else {
            // Update failed
            $_SESSION['error'] = "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt = null;
    }

    // Close connection
    $conn = null;
    header("location: update_details");
}
