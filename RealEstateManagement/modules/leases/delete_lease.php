<?php
require_once '../../inc/dbh.php';
include_once '../../inc/head.php';
include_once '../../inc/nav.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['lease_id'])) {
    $leaseId = $_GET['lease_id'];

    // Check if the lease exists
    $leaseInfo = getLeaseById($leaseId);

    if ($leaseInfo !== null) {
        // Lease found, display confirmation form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Delete the lease
            $result = deleteLease($leaseId);

            if ($result === true) {
                echo "Lease deleted successfully!";
            } else {
                echo "Error: " . $result;
            }
        }
    } else {
        echo "Lease not found.";
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
    <title>Delete Lease</title>
</head>
<body>
    <h1>Delete Lease</h1>

    <?php if ($leaseInfo !== null) : ?>
        <p>Are you sure you want to delete the lease with Lease ID: <?php echo $leaseInfo['lease_id']; ?>?</p>
        <form method="post" action="">
            <button type="submit">Yes, Delete</button>
        </form>
    <?php endif; ?>
</body>
</html>
