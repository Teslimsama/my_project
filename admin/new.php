<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "unibooks";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch data from the database
function fetchData($conn, $columnName)
{
    $data = array();
    $sql = "SELECT DISTINCT $columnName FROM university_faculty_department";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row[$columnName];
        }
    }

    return $data;
}

// Fetch data for each dropdown
$universities = fetchData($conn, 'University');
$faculties = fetchData($conn, 'Faculty');
$departments = fetchData($conn, 'Department');
$courses = fetchData($conn, 'Course');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
</head>

<body>
    <form method="post" action="school_input.php">
        <select class="select2" name="university" style="width: 100%;">
            <option value="">Select University</option>
            <?php
            foreach ($universities as $university) {
                echo "<option value='$university'>$university</option>";
            }
            ?>
        </select>
        <select class="select2" name="faculty" style="width: 100%;">
            <option value="">Select Faculty</option>
            <?php
            foreach ($faculties as $faculty) {
                echo "<option value='$faculty'>$faculty</option>";
            }
            ?>
        </select>
        <select class="select2" name="department" style="width: 100%;">
            <option value="">Select Department</option>
            <?php
            foreach ($departments as $department) {
                echo "<option value='$department'>$department</option>";
            }
            ?>
        </select>
        <select class="select2" name="course" style="width: 100%;">
            <option value="">Select Course</option>
            <?php
            foreach ($courses as $course) {
                echo "<option value='$course'>$course</option>";
            }
            ?>
        </select>
        <button type="submit">Submit</button>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                tags: true, // Allow user to enter custom values
                tokenSeparators: [',', ' '], // Define how to separate tags
            });
        });
    </script>
</body>

</html>