<?php
require_once '../../inc/dbh.php';
include_once '../../inc/head.php';
include_once '../../inc/nav.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $leaseId = $_POST['lease_id'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $rentAmount = $_POST['rent_amount'];

    // Update lease information
    $result = updateLease($leaseId, $startDate, $endDate, $rentAmount);

    if ($result === true) {
        echo "Lease information updated successfully!";
    } else {
        echo "Error: " . $result;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['lease_id'])) {

    $leaseId = $_GET['lease_id'];

    // Get lease information
    $leaseInfo = getLeaseById($leaseId);

    if ($leaseInfo !== null) {
        // Display a form to update lease information
        echo "<h1>Update Lease Information</h1>";
        echo "<form method='post' action=''>";
        echo "<input type='hidden' name='lease_id' value='{$leaseId}'>";
        echo "Start Date: <input type='date' name='start_date' value='{$leaseInfo['start_date']}' required><br>";
        // Add other form fields for end date, rent amount
        echo "<button type='submit'>Update</button>";
        echo "</form>";
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
    <title>Update Lease</title>
</head>
<body>
    <!-- Add a form or link to navigate to this page with a specific lease_id parameter -->
</body>
</html>
