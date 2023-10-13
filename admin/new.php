<?php
// Database connection using PDO
try {
    $pdo = new PDO('mysql:host=localhost;dbname=unibooks', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

// Fetch data for universities, departments, faculties, and courses from the database
try {
    $query = "SELECT university, department, faculty, course FROM university_faculty_department";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $options = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Query failed: ' . $e->getMessage());
}

// Create unique arrays for each type of option
$uniqueUniversities = [];
$uniqueDepartments = [];
$uniqueFaculties = [];
$uniqueCourses = [];

foreach ($options as $option) {
    $uniqueUniversities[$option['university']] = $option['university'];
    $uniqueDepartments[$option['department']] = $option['department'];
    $uniqueFaculties[$option['faculty']] = $option['faculty'];
    $uniqueCourses[$option['course']] = $option['course'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Select Options</title>
</head>

<body>
    <form method="post" id="dataForm">
        <label for="selectedUniversity">University:</label>
        <select name="selectedUniversity" id="selectedUniversity">
            <?php
            foreach ($uniqueUniversities as $value) {
                $selected = ($value == $selectedUniversity) ? 'selected' : '';
                echo "<option value='$value' $selected>$value</option>";
            }
            ?>
        </select><br>

        <label for="selectedDepartment">Department:</label>
        <select name="selectedDepartment" id="selectedDepartment">
            <?php
            foreach ($uniqueDepartments as $value) {
                $selected = ($value == $selectedDepartment) ? 'selected' : '';
                echo "<option value='$value' $selected>$value</option>";
            }
            ?>
        </select><br>

        <label for="selectedFaculty">Faculty:</label>
        <select name="selectedFaculty" id="selectedFaculty">
            <?php
            foreach ($uniqueFaculties as $value) {
                $selected = ($value == $selectedFaculty) ? 'selected' : '';
                echo "<option value='$value' $selected>$value</option>";
            }
            ?>
        </select><br>

        <label for="selectedCourse">Course:</label>
        <select name="selectedCourse" id="selectedCourse">
            <?php
            foreach ($uniqueCourses as $value) {
                $selected = ($value == $selectedCourse) ? 'selected' : '';
                echo "<option value='$value' $selected>$value</option>";
            }
            ?>
        </select><br>

        <input type="submit" value="Submit">
    </form>

    <!-- JavaScript to handle the form submission -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataForm').submit(function(event) {
                event.preventDefault();

                // Get the selected values
                var selectedUniversity = $('#selectedUniversity').val();
                var selectedDepartment = $('#selectedDepartment').val();
                var selectedFaculty = $('#selectedFaculty').val();
                var selectedCourse = $('#selectedCourse').val();

                // Send the selected values to the server for further processing
                $.ajax({
                    url: 'process_selection.php', // Create a new PHP script to handle the selection
                    method: 'POST',
                    data: {
                        selectedUniversity: selectedUniversity,
                        selectedDepartment: selectedDepartment,
                        selectedFaculty: selectedFaculty,
                        selectedCourse: selectedCourse
                    },
                    success: function(response) {
                        // Handle the response from the server, if needed
                    }
                });
            });
        });
    </script>
</body>

</html>