<?php
//fetch.php
include "session.php";
if (isset($_POST["action"])) {
    // $connect = mysqli_connect("localhost", "root", "", "unibooks");
    $output = '';
    if ($_POST["action"] == "university") {
        $query = "SELECT faculty FROM university_faculty_department WHERE university = '" . $_POST["query"] . "' GROUP BY faculty";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $output .= '<option value="">Select faculty</option>';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $output .= '<option value="' . $row["faculty"] . '">' . $row["faculty"] . '</option>';
        }
    }
    if ($_POST["action"] == "faculty") {
        $query = "SELECT department FROM university_faculty_department WHERE faculty = '" . $_POST["query"] . "'GROUP BY department";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $output .= '<option value="">Select department</option>';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $output .= '<option value="' . $row["department"] . '">' . $row["department"] . '</option>';
        }
    }
    if ($_POST["action"] == "department") {
        $query = "SELECT course FROM university_faculty_department WHERE department = '" . $_POST["query"] . "'GROUP BY course";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $output .= '<option value="">Select course</option>';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $output .= '<option value="' . $row["course"] . '">' . $row["course"] . '</option>';
        }
    }
    echo $output;
}
