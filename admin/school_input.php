<?php
include "session.php";
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
        header('location:add_university');
    } else {
        // The combination doesn't exist, insert it
        $stmt = $conn->prepare("INSERT INTO university_faculty_department (university, faculty, department, course) VALUES (?, ?, ?, ?)");
        $stmt->execute([$university, $faculty, $department, $course]);
        $_SESSION['success'] = "Combination inserted into the database.";
        header('location:add_university');
    }
}