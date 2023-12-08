<?php
require_once '../../inc/dbh.php';
include_once '../../inc/head.php';
include_once '../../inc/nav.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['property_id'])) {
    $propertyId = $_GET['property_id'];

    // Check if the property exists
    $propertyInfo = getPropertyById($propertyId);

    if ($propertyInfo !== null) {
        // Property found, display confirmation form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Delete the property
            $result = deleteProperty($propertyId);

            if ($result === true) {
                echo "Property deleted successfully!";
            } else {
                echo "Error: " . $result;
            }
        }
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
    <title>Delete Property</title>
</head>
<body>
    <h1>Delete Property</h1>

    <?php if ($propertyInfo !== null) : ?>
        <p>Are you sure you want to delete the property with Property ID: <?php echo $propertyInfo['property_id']; ?>?</p>
        <form method="post" action="">
            <button type="submit">Yes, Delete</button>
        </form>
    <?php endif; ?>
</body>
</html>
