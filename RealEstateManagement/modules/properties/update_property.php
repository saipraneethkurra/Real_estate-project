<?php
require_once '../../inc/dbh.php';
include_once '../../inc/head.php';
include_once '../../inc/nav.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['property_id'])) {
    $propertyId = $_POST['property_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];
    $price = $_POST['price'];

    // Update property information
    $result = updateProperty($propertyId, $title, $description, $image_url, $price);

    if ($result === true) {
        echo "Property information updated successfully!";
    } else {
        echo "Error: " . $result;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['property_id'])) {
    $propertyId = $_GET['property_id'];

    // Get property information
    $propertyInfo = getPropertyById($propertyId);

    if ($propertyInfo !== null) {
        echo "<h1>Update Property Information</h1>";
        echo "<form method='post' action=''>";
        echo "<input type='hidden' name='property_id' value='{$propertyId}'>";
        echo "Title: <input type='text' name='title' value='{$propertyInfo['title']}' required><br>";
        echo "Description: <textarea name='description' required>{$propertyInfo['description']}</textarea><br>";
        echo "Image URL: <input type='text' name='image_url' value='{$propertyInfo['image_url']}'><br>";
        echo "Price: <input type='text' name='price' value='{$propertyInfo['price']}' required><br>";
        echo "<button type='submit'>Update</button>";
        echo "</form>";
    } else {
        echo "Property not found.";
    }
} else {
    echo "Invalid request.";
}
?>

