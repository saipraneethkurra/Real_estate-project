<?php
require_once '../../inc/dbh.php';
include_once '../../inc/head.php';
include_once '../../inc/nav.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['lease_id'])) {

    $leaseId = $_GET['lease_id'];

    // Get lease information
    $leaseInfo = getLeaseById($leaseId);

    if ($leaseInfo !== null) {
        // Display lease information
        echo "<h1>Lease Information</h1>";
        echo "<p>Tenant ID: {$leaseInfo['tenant_id']}</p>";
        echo "<p>Start Date: {$leaseInfo['start_date']}</p>";
        echo "<p>End Date: {$leaseInfo['end_date']}</p>";
        echo "<p>Rent Amount: {$leaseInfo['rent_amount']}</p>";
        echo "<p>Payment Status: {$leaseInfo['payment_status']}</p>";
    } else {
        echo "Lease not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Lease</title>
</head>
<body>
    <!-- Add a form or link to navigate to this page with a specific lease_id parameter -->
</body>
</html>
