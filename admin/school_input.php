<?php
include "session.php";
include '../alert.message.php';
// Check if the form is submitted
if (isset($_POST['search'])) {
    // Get the form data
    $university = $_POST['university'];
    $faculty = $_POST['faculty'];
    $department = $_POST['dept'];
    $course = $_POST['course'];

    // Prepare the SQL statement
    $sql = "INSERT INTO university_faculty_department (university, faculty, department, course) VALUES (:university, :faculty, :department, :course)";

    // ...
    try {
        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind the parameters
        $stmt->bindParam(':university', $university);
        $stmt->bindParam(':faculty', $faculty);
        $stmt->bindParam(':department', $department);
        $stmt->bindParam(':course', $course);

        // Execute the statement
        $stmt->execute();

        // Redirect the user to the upload page
        header("Location: upload.php");
        $_SESSION['success'] = 'Done';
        exit(); // Important: Terminate the current script

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
    // ...
    header("Location: upload.php");
    $_SESSION['error'] = "Query failed: " . $e->getMessage();
}
