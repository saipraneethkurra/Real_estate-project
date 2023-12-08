

<?php
require_once '../../inc/dbh.php';
include_once '../../inc/head.php';
include_once '../../inc/nav.php'; 
?>
<div class="container">

<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['tenant_id'])) {

    $tenantId = $_GET['tenant_id'];

    // Get tenant information
    $tenantInfo = getTenantById($tenantId);

    if ($tenantInfo !== null) {
        // Display tenant information
        echo "<div class='container mt-5'>";
        echo "<div class='row'>";
        echo "<div class='col-md-6'>";
        echo "<div class='card'>";
        echo "<div class='card-body'>";
        echo "<h1 class='card-title'>Tenant Information</h1>";
        echo "<p class='card-text'>Name: {$tenantInfo['first_name']} {$tenantInfo['last_name']}</p>";
        echo "<p class='card-text'>Contact Number: {$tenantInfo['contact_number']}</p>";
        echo "<p class='card-text'>Email: {$tenantInfo['email']}</p>";
        echo "<p class='card-text'>Rental History: {$tenantInfo['rental_history']}</p>";
        echo "<p class='card-text'>Lease Terms: {$tenantInfo['lease_terms']}</p>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        
    } else {
        echo "Tenant not found.";
    }
}
?>
</div>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Tenant</title>
</head>
<body>
    <!-- Add a form or link to navigate to this page with a specific tenant_id parameter -->
</body>
</html>
