<?php
function createImage($outputPath, $width = 233, $height = 181)
{
    // Check if the GD library is enabled
    if (!extension_loaded('gd')) {
        die('GD library is not enabled.');
    }

    // Create a blank image
    $image = imagecreatetruecolor($width, $height);

    // Set the background color to white
    $white = imagecolorallocate($image, 255, 255, 255);
    imagefill($image, 0, 0, $white);

    // Set the text color to black
    $black = imagecolorallocate($image, 0, 0, 0);

    // Set the path to the font you want to use
    $font = __DIR__ . '/Elegante Classica.ttf'; // Ensure this path is correct and the font file exists

    // Define text and positions
    $texts = ["VTAN303", "DAIRY AND", "PRODUCT", "PROCESSING"];
    $fontSize = 16; // Adjust font size as necessary

    // Calculate positions dynamically based on the dimensions of the image
    $boundingBox = imagettfbbox($fontSize, 0, $font, "VTAN303");
    $x1 = ($width - $boundingBox[4]) / 2;
    $y1 = ($height / 4);

    $boundingBox = imagettfbbox($fontSize, 0, $font, "DAIRY AND");
    $x2 = ($width - $boundingBox[4]) / 2;
    $y2 = ($height / 2) - ($boundingBox[5] / 2);

    $boundingBox = imagettfbbox($fontSize, 0, $font, "PRODUCT");
    $x3 = ($width - $boundingBox[4]) / 2;
    $y3 = ($height / 1.5) - ($boundingBox[5] / 2);

    $boundingBox = imagettfbbox($fontSize, 0, $font, "PROCESSING");
    $x4 = ($width - $boundingBox[4]) / 2;
    $y4 = ($height / 1.2) - ($boundingBox[5] / 2);

    $positions = [
        [$x1, $y1],
        [$x2, $y2],
        [$x3, $y3],
        [$x4, $y4]
    ];

    // Add text to the image
    foreach ($texts as $index => $text) {
        list($x, $y) = $positions[$index];
        imagettftext($image, $fontSize, 0, $x, $y, $black, $font, $text);
    }

    // Save the image to a file
    imagejpeg($image, $outputPath);

    // Free up memory
    imagedestroy($image);
}

// Example usage
$outputPath = __DIR__ . '/output_image.jpg';
createImage($outputPath);
echo "Image created successfully at $outputPath";
