<?php
$conn = new PDO('mysql:host=localhost;dbname=unibooks', 'root', '');
include("function.php");

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
        $image_path = "../Images/" . $image;
        if(file_exists($image_path))
        {
            unlink($image_path);
        }
    }

    echo 'Data Deleted';
}
?>
