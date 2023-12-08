<?php
require_once '../../inc/dbh.php';
include_once '../../inc/head.php';
include_once '../../inc/nav.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['property_id'])) {
    $propertyId = $_GET['property_id'];

    // Get property information
    $propertyInfo = getPropertyById($propertyId);

    if ($propertyInfo !== null) {
        echo "<h1>{$propertyInfo['title']}</h1>";
        echo "<p>Description: {$propertyInfo['description']}</p>";
        echo "<p>Price: ${$propertyInfo['price']}</p>";
        echo "<p>Status: {$propertyInfo['status']}</p>";
    } else {
        echo "Property not found.";
    }
} else {
    echo "Invalid request.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Property</title>
</head>
<body>
    <!-- Additional styling or content can be added as needed -->
</body>
</html>
