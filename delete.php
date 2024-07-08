<?php
require_once __DIR__ . '/vendor/autoload.php';

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

if(isset($_POST["product_id"]))
{
    $product_id = $_POST["product_id"];

    // Get the image name from producttb
    $image = get_image_name($product_id);

    // Delete the product from producttb
    $statement = $conn->prepare("DELETE FROM producttb WHERE product_name = :product_id");
    $statement->execute(array(':product_id' => $product_id));

    // Delete the product from search
    $statement = $conn->prepare("DELETE FROM search WHERE title = :product_name");
    $statement->execute(array(':product_name' => $image));

    // Delete the product image file
    if(!empty($image))
    {
        $image_path = "assets/Images/" . $image;
        if(file_exists($image_path))
        {
            unlink($image_path);
        }
    }

    echo 'Data Deleted';
}
?>
