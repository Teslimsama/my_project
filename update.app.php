<?php
include 'session.php';
include 'slugify.php'; // Assuming this is a custom function for creating slugs

if (isset($_POST['submit'])) {
    $curr_password = $_POST['curr_password'];
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $university = $_POST['university'];

    $password = $_POST['password'];
    $username = $_POST['username'];
    $level = $_POST['level'];
    $dept = $_POST['department'];
    $course = $_POST['course'];
    $faculty = $_POST['faculty'];
    $dob = $_POST['dob'];
    $photo = $_FILES['photo'];

    // if (password_verify($curr_password, $user['password'])) {
        $image_path = $user['image']; // Existing image path

        // Check if a new image was uploaded
        if ($photo['error'] == UPLOAD_ERR_OK) {
            // Set the target directory
            $target_dir = "pfp/";

            // Create a new filename using the naming convention and slugify function
            $slug = slugify($first_name . " " . $last_name . " unibooks.com.ng");
            $imageFileType = strtolower(pathinfo($photo["name"], PATHINFO_EXTENSION));
            $new_file_name = $slug . '.' . $imageFileType;
            $target_file = $target_dir . $new_file_name;

            // Check if file is an actual image
            $check = getimagesize($photo["tmp_name"]);
            if ($check !== false) {
                // Check file size (e.g., 5MB limit)
                if ($photo["size"] <= 5000000) {
                    // Allow certain file formats
                    if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                        // Delete the existing image if it exists
                        if (!empty($user['photo']) && file_exists($user['photo'])) {
                            unlink($user['photo']);
                        }

                        // Attempt to move the uploaded file to the target directory
                        if (move_uploaded_file($photo["tmp_name"], $target_file)) {
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
        }

        if ($password == $user['password']) {
            $password = $user['password'];
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
        }

        $conn = $pdo->open();

        try {
            $stmt = $conn->prepare("UPDATE unibooker SET email=:email, password=:password, firstname=:firstname, lastname=:lastname, level=:level, school=:school, faculty=:faculty, department=:department, course=:course, image=:image, username=:username WHERE id=:id");
            $stmt->execute([
                'email' => $email,
                'password' => $password,
                'firstname' => $first_name,
                'lastname' => $last_name,
                'level' => $level,
                'school' => $university,
                'faculty' => $faculty,
                'department' => $dept,
                'course' => $course,
                'image' => $image_path,
                'username' => $username,
                'id' => $user['id']
            ]);

            $_SESSION['success'] = 'Account updated successfully';
        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        $pdo->close();
    // } else {
    //     $_SESSION['error'] = 'Incorrect password';
    // }
} else {
    $_SESSION['error'] = 'Fill up required details first';
}

header("location: update_details");
