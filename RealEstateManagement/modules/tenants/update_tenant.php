<?php
require_once '../../inc/dbh.php';
include_once '../../inc/head.php';
include_once '../../inc/nav.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $tenantId = $_POST['tenant_id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $contactNumber = $_POST['contact_number'];
    $email = $_POST['email'];
    $rentalHistory = $_POST['rental_history'];
    $leaseTerms = $_POST['lease_terms'];

    // Update tenant information
    $result = updateTenant($tenantId, $firstName, $lastName, $contactNumber, $email, $rentalHistory, $leaseTerms);

    if ($result === true) {
        echo "Tenant information updated successfully!";
    } else {
        echo "Error: " . $result;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['tenant_id'])) {

    $tenantId = $_GET['tenant_id'];

    // Get tenant information
    $tenantInfo = getTenantById($tenantId);

    if ($tenantInfo !== null) {
        // Display a form to update tenant information
        echo "<div class='container mt-5'>";
        echo "<div class='row'>";
        echo "<div class='col-md-6'>";
        echo "<div class='card'>";
        echo "<div class='card-body'>";
        echo "<h1 class='card-title'>Update Tenant Information</h1>";
        
        echo "<form method='post' action=''>";
        echo "<input type='hidden' name='tenant_id' value='{$tenantId}'>";
        
        // First Name
        echo "<div class='form-group'>";
        echo "<label for='first_name'>First Name:</label>";
        echo "<input type='text' class='form-control' name='first_name' value='{$tenantInfo['first_name']}' required>";
        echo "</div>";
        
        // Add other form fields for last name, contact number, email, rental history, lease terms
        // Last Name
        echo "<div class='form-group'>";
        echo "<label for='last_name'>Last Name:</label>";
        echo "<input type='text' class='form-control' name='last_name' value='{$tenantInfo['last_name']}' required>";
        echo "</div>";
        
        // Contact Number
        echo "<div class='form-group'>";
        echo "<label for='contact_number'>Contact Number:</label>";
        echo "<input type='text' class='form-control' name='contact_number' value='{$tenantInfo['contact_number']}' required>";
        echo "</div>";
        
        // Email
        echo "<div class='form-group'>";
        echo "<label for='email'>Email:</label>";
        echo "<input type='email' class='form-control' name='email' value='{$tenantInfo['email']}' required>";
        echo "</div>";
        
        // Rental History
        echo "<div class='form-group'>";
        echo "<label for='rental_history'>Rental History:</label>";
        echo "<textarea class='form-control' name='rental_history'>{$tenantInfo['rental_history']}</textarea>";
        echo "</div>";
        
        // Lease Terms
        echo "<div class='form-group'>";
        echo "<label for='lease_terms'>Lease Terms:</label>";
        echo "<textarea class='form-control' name='lease_terms'>{$tenantInfo['lease_terms']}</textarea>";
        echo "</div>";
        
        echo "<button type='submit' class='btn btn-primary'>Update</button>";
        echo "</form>";
        
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Tenant</title>
</head>
<body>
    <!-- Add a form or link to navigate to this page with a specific tenant_id parameter -->
</body>
</html>
