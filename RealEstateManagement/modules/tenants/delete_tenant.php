<?php
require_once '../../inc/dbh.php';
include_once '../../inc/head.php';
include_once '../../inc/nav.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['tenant_id'])) {
    $tenantId = $_GET['tenant_id'];

    // Check if the tenant exists
    $tenantInfo = getTenantById($tenantId);

    if ($tenantInfo !== null) {
        // Tenant found, display confirmation form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Delete the tenant
            $result = deleteTenant($tenantId);

            if ($result === true) {
                echo "Tenant deleted successfully!";
            } else {
                echo "Error: " . $result;
            }
        }
    } else {
        echo "Tenant not found.";
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
    <title>Delete Tenant</title>
</head>
<body>
    <h1>Delete Tenant</h1>

    <?php if ($tenantInfo !== null) : ?>
        <p>Are you sure you want to delete the tenant with Tenant ID: <?php echo $tenantInfo['tenant_id']; ?>?</p>
        <form method="post" action="">
            <button type="submit">Yes, Delete</button>
        </form>
    <?php endif; ?>
</body>
</html>
