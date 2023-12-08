<?php
require_once '../../inc/dbh.php';
include_once '../../inc/head.php';
include_once '../../inc/nav.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request_id'])) {
    $requestId = $_POST['request_id'];
    $resolutionDescription = $_POST['resolution_description'];

    // Update maintenance request information
    $result = updateMaintenanceRequest($requestId, $resolutionDescription);

    if ($result === true) {
        echo "Maintenance Request updated successfully!";
    } else {
        echo "Error: " . $result;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['request_id'])) {
    $requestId = $_GET['request_id'];

    // Get maintenance request information
    $requestInfo = getMaintenanceRequestById($requestId);

    if ($requestInfo !== null) {
        echo "<h1>Update Maintenance Request {$requestInfo['request_id']}</h1>";
        echo "<form method='post' action=''>";
        echo "<input type='hidden' name='request_id' value='{$requestId}'>";
        echo "<label for='resolution_description'>Resolution Description:</label>";
        echo "<textarea name='resolution_description'></textarea><br>";
        echo "<button type='submit'>Update</button>";
        echo "</form>";
    } else {
        echo "Maintenance Request not found.";
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
    <title>Update Maintenance Request</title>
</head>
<body>
    <!-- Additional styling or content can be added as needed -->
</body>
</html>
