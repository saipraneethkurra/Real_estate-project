<?php
require_once '../../inc/dbh.php';
include_once '../../inc/head.php';
include_once '../../inc/nav.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['request_id'])) {
    $requestId = $_GET['request_id'];

    // Get maintenance request information
    $requestInfo = getMaintenanceRequestById($requestId);

    if ($requestInfo !== null) {
        echo "<h1>Maintenance Request {$requestInfo['request_id']}</h1>";
        echo "<p>Tenant ID: {$requestInfo['tenant_id']}</p>";
        echo "<p>Description: {$requestInfo['request_description']}</p>";
        echo "<p>Request Date: {$requestInfo['request_date']}</p>";
        echo "<p>Status: {$requestInfo['status']}</p>";
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
    <title>View Maintenance Request</title>
</head>
<body>
    <!-- Additional styling or content can be added as needed -->
</body>
</html>
