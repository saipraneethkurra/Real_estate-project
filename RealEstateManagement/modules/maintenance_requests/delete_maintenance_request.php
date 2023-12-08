<?php
require_once '../../inc/dbh.php';
include_once '../../inc/head.php';
include_once '../../inc/nav.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['request_id'])) {
    $requestId = $_GET['request_id'];

    // Check if the maintenance request exists
    $requestInfo = getMaintenanceRequestById($requestId);

    if ($requestInfo !== null) {
        // Maintenance request found, display confirmation form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Delete the maintenance request
            $result = deleteMaintenanceRequest($requestId);

            if ($result === true) {
                echo "Maintenance Request deleted successfully!";
            } else {
                echo "Error: " . $result;
            }
        }
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
    <title>Delete Maintenance Request</title>
</head>
<body>
    <h1>Delete Maintenance Request</h1>

    <?php if ($requestInfo !== null) : ?>
        <p>Are you sure you want to delete Maintenance Request with ID: <?php echo $requestInfo['request_id']; ?>?</p>
        <form method="post" action="">
            <button type="submit">Yes, Delete</button>
        </form>
    <?php endif; ?>
</body>
</html>
