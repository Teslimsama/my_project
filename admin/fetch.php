<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require 'function.php'; // Use require instead of include for better error handling
$dbHost = $_ENV['DB_HOST'];
$dbName = $_ENV['DB_NAME']; // Add this line to get the database name
$dbUser = $_ENV['DB_USER'];
$dbPass = $_ENV['DB_PASS'];

// Create a PDO instance and set error mode to exceptions
try {
    // Correct the DSN format
    $conn = new PDO($dbHost . ';dbname=' . $dbName, $dbUser, $dbPass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle database connection error
    die("Database connection failed: " . $e->getMessage());
}

// Get total number of records in the table
$totalRecords = get_total_all_records($conn);

// Initialize variables for the search term and ordering
$searchValue = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';
$orderColumn = isset($_POST['order'][0]['column']) ? $_POST['order'][0]['column'] : 'id';
$orderDir = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'DESC';

// Prepare the SELECT query
$query = "SELECT * FROM producttb WHERE product_name LIKE :search OR product_image LIKE :search OR product_price LIKE :search OR university LIKE :search OR faculty LIKE :search OR department LIKE :search OR level LIKE :search ORDER BY $orderColumn $orderDir";

// Apply pagination if length is specified
if ($_POST['length'] != -1) {
    $query .= " LIMIT :start, :length";
}

// Prepare and execute the query
$statement = $conn->prepare($query);
$statement->bindValue(':search', "%$searchValue%");
if ($_POST['length'] != -1) {
    $statement->bindValue(':start', $_POST['start'], PDO::PARAM_INT);
    $statement->bindValue(':length', $_POST['length'], PDO::PARAM_INT);
}
$statement->execute();

// Fetch the results
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

// Format the data for output
$data = [];
foreach ($result as $row) {
    $image = $row["product_image"] ? '<img src="../assets/Images/' . $row["product_image"] . '"id="' . $row['product_name'] . '" class="img-thumbnail update" width="50" height="35" />' : '';
    $type = $row['type'] === 1 ? 'Free Book' : 'Project';

    $sub_array = [
        $row['id'],
        $image,
        $row['product_name'],
        '₦' . $row['product_price'],
        $type,
        $row['university'],
        $row['faculty'],
        $row['department'],
        $row['level'] . 'L',
        '<a href="javascript:;" class="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-ellipsis-v"></i>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a class="dropdown-item edit" href="books_edit.php?id=' . $row['product_name'] . '">Edit</a>
            </li>
            <li>
                <button type="button" name="delete" id="' . $row['product_name'] . '" class="dropdown-item delete">Delete</button>
            </li>
        </ul>'
    ];

    $data[] = $sub_array;
}

// Prepare the output array
$output = [
    'draw' => intval($_POST['draw']),
    'recordsTotal' => $totalRecords,
    'recordsFiltered' => count($result),
    'data' => $data
];

// Send the JSON response
echo json_encode($output);

